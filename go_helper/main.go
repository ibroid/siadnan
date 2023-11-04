package main

import (
	"archive/zip"
	"flag"
	"fmt"
	"io"
	"log"
	"net/http"
	"os"
	"path"
	"strings"
)

var (
	par     string
	db_host string
	db_name string
	db_user string
	db_pass string
)

func main() {

	flag.StringVar(&par, "do", "", "Initialize database ke config/database.php")

	flag.StringVar(&db_host, "db_host", "127.0.0.1", "Set database host")
	flag.StringVar(&db_name, "db_name", "siadnan", "Set database name")
	flag.StringVar(&db_user, "db_user", "root", "Set database user")
	flag.StringVar(&db_pass, "db_pass", "", "Set database pass")

	flag.Parse()

	switch par {
	case "init_db":
		InitializeDatabase()
	case "auto_db":
		AutoloadDatabase()
	default:
		log.Println("Nothing to do")
	}

}

func AutoloadDatabase() {
	input, err := os.ReadFile("../application/config/autoload.php")
	if err != nil {
		log.Fatalln("Gagal read : ", err)
	}

	lines := strings.Split(string(input), "\n")

	for i, line := range lines {
		if strings.Contains(line, "// 'database',") {
			lines[i] = "	'database',"
		}
	}

	output := strings.Join(lines, "\n")
	err = os.WriteFile("../application/config/autoload.php", []byte(output), 0644)
	if err != nil {
		log.Fatalln("Gagal write :", err)
	}

	log.Println("autoload.php was updated")
}

func InitializeDatabase() {

	dbtemplate, err := os.ReadFile("./database.txt")
	if err != nil {
		log.Fatalln("Gagal read : ", err)
	}

	lines := strings.Split(string(dbtemplate), "\n")
	lines[len(lines)-1] = fmt.Sprintf("$db['default']['hostname'] = '%v';\n$db['default']['username'] = '%v';\n$db['default']['password'] = '%v';\n$db['default']['database'] = '%v';\n", db_host, db_user, db_pass, db_name)

	output := strings.Join(lines, "\n")
	if err := os.WriteFile("../application/config/database.php", []byte(output), 0644); err != nil {
		log.Fatalln("Gagal write :", err)
	}

	log.Println("database.php was updated")
}

func DownloadAssets() {
	specUrl := "https://filebrowser.pajakartautara.id/api/public/dl/h0sMk9ps/"
	resp, err := http.Get(specUrl)
	if err != nil {
		log.Fatalln("Gagal get url : ", err)
	}

	defer resp.Body.Close()
	fmt.Println("status", resp.Status)
	if resp.StatusCode != 200 {
		log.Fatalln("Gagal connect. server status down : ", err)
	}

	// Create the file
	out, err := os.Create("test.zip")
	if err != nil {
		fmt.Printf("Gagal ngezip: %s", err)
	}
	defer out.Close()

	// Write the body to file
	_, err = io.Copy(out, resp.Body)
	if err != nil {
		log.Fatalln("Gagal copy : ", err)
	}
}

func Unzip(name string) {
	filename := fmt.Sprintf("%s.zip", name)

	reader, _ := zip.OpenReader(filename)

	defer reader.Close()

	for _, file := range reader.File {
		in, _ := file.Open()
		defer in.Close()
		relname := path.Join("packages", name, file.Name)
		dir := path.Dir(relname)
		os.MkdirAll(dir, 0777)
		out, _ := os.Create(relname)
		defer out.Close()
		io.Copy(out, in)
	}
}
