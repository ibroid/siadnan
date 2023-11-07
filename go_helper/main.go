package main

import (
	"archive/zip"
	"flag"
	"fmt"
	"io"
	"log"
	"net/http"
	"os"
	"path/filepath"
	"strings"

	"golang.org/x/crypto/bcrypt"
)

var (
	par      string
	db_host  string
	db_name  string
	db_user  string
	db_pass  string
	password string
)

var StoredPassword = "$2a$14$N8F5sjq3YanDC9pNP.D0Eu5RBHAyMawC06xwBDoBPpn8cBr7iwrH6"

// LINK DI HIDDEN SETELAH KOMPILASI, DAN TERSEDIA DI COMPILED FILE
var assetsSource = "#"

func main() {

	flag.StringVar(&par, "do", "", "Initialize database ke config/database.php")

	flag.StringVar(&db_host, "db_host", "127.0.0.1", "Set database host")
	flag.StringVar(&db_name, "db_name", "siadnan", "Set database name")
	flag.StringVar(&db_user, "db_user", "root", "Set database user")
	flag.StringVar(&db_pass, "db_pass", "", "Set database pass")

	flag.StringVar(&password, "pass", "", "Password untuk download assets")
	flag.Parse()

	err := bcrypt.CompareHashAndPassword([]byte(StoredPassword), []byte(password))
	if err != nil {
		panic("Password Doesnt Match")
	}

	switch par {
	case "init_db":
		InitializeDatabase()
	case "auto_db":
		AutoloadDatabase()
	case "download_assets":
		DownloadAssets()
	case "link_assets":
		fmt.Println(assetsSource)
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
	specUrl := assetsSource
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
	out, err := os.Create("../assets.zip")
	if err != nil {
		fmt.Printf("Gagal ngezip: %s", err)
	}
	defer out.Close()

	// Write the body to file
	_, err = io.Copy(out, resp.Body)
	if err != nil {
		log.Fatalln("Gagal copy : ", err)
	}

	Unzip()
}

func Unzip() {
	os.Remove("../assets")
	os.Mkdir("../assets", 0775)

	zipFileName := "../assets.zip"

	defer os.Remove("../assets.zip")

	reader, err := zip.OpenReader(zipFileName)
	if err != nil {
		fmt.Println("Gagal membuka file ZIP:", err)
		return
	}
	defer reader.Close()

	for _, file := range reader.File {
		zippedFile, err := file.Open()
		if err != nil {
			fmt.Println("Gagal membuka file di dalam arsip:", err)
			return
		}
		defer zippedFile.Close()

		extractedFilePath := filepath.Join("../assets", file.Name) // Membuat path untuk file hasil ekstraksi
		if file.FileInfo().IsDir() {
			// Jika file di dalam ZIP adalah folder, buat direktori
			err := os.MkdirAll(extractedFilePath, os.ModePerm)
			if err != nil {
				fmt.Println("Gagal membuat direktori:", err)
				return
			}
			fmt.Println("Direktori", extractedFilePath, "dibuat.")
			continue
		}

		extractedFile, err := os.Create(extractedFilePath)
		if err != nil {
			fmt.Println("Gagal membuat file:", err)
			return
		}
		defer extractedFile.Close()

		_, err = io.Copy(extractedFile, zippedFile)
		if err != nil {
			fmt.Println("Gagal menyalin isi file:", err)
			return
		}

		fmt.Println("File", extractedFilePath, "diekstrak.")
	}
}
