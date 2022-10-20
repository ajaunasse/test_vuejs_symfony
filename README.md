# test_vuejs_symfony

### Requirements
* php >= 8.0
* composer
* nodejs >= 16.0
* Make
* mysql

### First installation

Open a terminal and run 
```
$ git clone https://github.com/ajaunasse/test_vuejs_symfony.git
$ cd test_vuejs_symfony
$ make install
```

Running the app locally

#### Backend
Default backend-port is 8000, you can modify it on the .env file.
```
$ make start-backend
```

#### Front-end
Open a new tab in the terminal and run
```
$ make start-front
```
Open your browser with and go to this address http://localhost:5173


### Run tests
```
$ make test
```

