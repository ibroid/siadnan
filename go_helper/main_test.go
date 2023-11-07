package main

import (
	"flag"
	"log"
	"testing"

	"golang.org/x/crypto/bcrypt"
)

var SendedPassword string

func init() {
	flag.StringVar(&SendedPassword, "pass", "", "Password untuk download assets")

}

func TestMatchPassword(t *testing.T) {
	// var password string
	flag.Parse()

	log.Println("stored pass : ", StoredPassword)
	log.Println("sended pass : ", SendedPassword)
	err := bcrypt.CompareHashAndPassword([]byte(StoredPassword), []byte(SendedPassword))
	if err != nil {
		log.Panicln("gagal match : ", err)
	}
}

func TestGeneratePassword(t *testing.T) {
	pass, _ := bcrypt.GenerateFromPassword([]byte("...secret"), 14)
	log.Println(string(pass))
}
