GOOS=windows GOARCH=amd64 go build -o go_helper_win.exe && GOOS=darwin GOARCH=arm64 go build -o go_helper_mac && GOOS=linux GOARCH=amd64 go build -o go_helper_linux