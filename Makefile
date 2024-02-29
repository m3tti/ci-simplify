docker:=docker
project_name:=pinvoice

db-stop: 
	${docker} container stop ${project_name}
	${docker} container rm ${project_name}

db: 
	${docker} run -d --name ${project_name} -p 3306:3306 -e MARIADB_ROOT_PASSWORD=test -e MARIADB_DATABASE=${project_name} -v ${project_name}-mysql-data:/var/lib/mysql mariadb:latest

assets:
	mkdir -p public/css
	mkdir -p public/js
	mkdir -p public/img
	wget https://raw.githubusercontent.com/tachyons-css/tachyons/master/css/tachyons.min.css -O public/css/tachyons.min.css
	wget https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js -O public/js/alpine.min.js
	wget https://unpkg.com/htmx.org@1.9.10/dist/htmx.min.js -O public/js/htmx.min.js
	wget https://unpkg.com/feather-icons/dist/feather-sprite.svg -O public/img/feather-sprite.svg

sync-strato: 
	rsync -av -e ssh --exclude-from='rsync-exclude' . strato:~/reitplan/