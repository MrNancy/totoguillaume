# totoguillaume

## setup

composer
```composer install```

npm
```npm install```

building encore packages
```encore production```


nginx settings
```
location / {
	try_files $uri $uri/ /index.php?$args;
}
```
