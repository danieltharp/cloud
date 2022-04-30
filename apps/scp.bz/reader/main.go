package main

import (
	"database/sql"
	"fmt"
	_ "github.com/go-sql-driver/mysql"
	"log"
	"net/http"
	"os"
	"regexp"
	"time"
)

var db *sql.DB

func forward(w http.ResponseWriter, req *http.Request) {
	var url string
	shortcode := req.URL.Path[1:]

	// Answer healthchecks from K8s
	if shortcode == "healthcheck" {
		w.Header().Set("Content-Type", "text/plain")
		w.WriteHeader(http.StatusOK)
		w.Write([]byte("ok"))
		return
	}

	// Send blank requests on to the wiki
	if shortcode == "" {
		http.Redirect(w, req, "https://scp-wiki.wikidot.com/", 301)
		return
	}

	// If we have a request for just 3 or 4 numbers, send immediately to the associated article.
	numbers, _ := regexp.MatchString("\\d{3,4}", shortcode)
	if numbers == true {
		http.Redirect(w, req, "https://scp-wiki.wikidot.com/scp-"+shortcode, 301)
		return
	}

	aliasQuery := db.QueryRow("select url from urls where alias = ?", shortcode)
	switch err := aliasQuery.Scan(&url); err {
	case sql.ErrNoRows:
		// Nothing found at that alias, try the auto-generated code
		codeQuery := db.QueryRow("select url from urls where code = ?", shortcode)
		switch err2 := codeQuery.Scan(&url); err2 {
		case sql.ErrNoRows:
			// We don't have anything to forward, just send them on to the wiki at that address.
			http.Redirect(w, req, "https://scp-wiki.wikidot.com/"+shortcode, 302)
			return
		case nil:
			// We have a code but not an alias
			http.Redirect(w, req, url, 301)
			return
		default:
			fmt.Println(err2)
			http.Redirect(w, req, "https://scp-wiki.wikidot.com/", 302)
		}
	case nil:
		// We have an alias
		http.Redirect(w, req, url, 301)
		return
	default:
		fmt.Println(err)
		http.Redirect(w, req, "https://scp-wiki.wikidot.com/", 302)

	}
}

func main() {
	fmt.Println("Connecting to " + os.Getenv("SCP_BZ_STRING"))
	var dbErr error
	db, dbErr = sql.Open("mysql", os.Getenv("SCP_BZ_STRING"))
	if dbErr != nil {
		panic(dbErr)
	}

	fmt.Println("Connected!")
	// See "Important settings" section.
	db.SetConnMaxLifetime(time.Minute * 2)
	db.SetMaxOpenConns(5)
	db.SetMaxIdleConns(5)

	http.HandleFunc("/", forward)

	listenerErr := http.ListenAndServe(":8080", nil)
	if listenerErr != nil {
		log.Fatal("ListenAndServe: ", listenerErr)
	}
}
