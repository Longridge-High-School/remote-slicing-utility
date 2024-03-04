# Remote Slicing Utility

A simple app to slice .STL files on a server.

### Build Command
```docker build -t remote-slicing-utility .```

Uncomment the commented lines in ```Dockerfile``` to build a release container with all app files built in.

### Run Command (Development)
```docker run -it -p 80:80 -v %CD%/app:/var/www/html remote-slicing-utility bash ```
