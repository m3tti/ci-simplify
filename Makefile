BOOTSTRAP_VERSION:=5.3.3
BOOTSTRAP_ICON_VERSION:=1.11.3
JQUERY_VERSION:=3.7.1

assets:
	mkdir -p public/css
	mkdir -p public/js
	mkdir -p public/img
	mkdir -p scss
	wget https://github.com/twbs/bootstrap/archive/v${BOOTSTRAP_VERSION}.zip
	wget https://cdn.jsdelivr.net/npm/bootstrap-icons@${BOOTSTRAP_ICON_VERSION}/font/bootstrap-icons.min.css -O public/css/bootstrap-icons.min.css
	wget https://code.jquery.com/jquery-${JQUERY_VERSION}.slim.min.js -O public/js/jquery.slim.min.js

	unzip -d bootstrap v${BOOTSTRAP_VERSION}.zip
	cp -r bootstrap/bootstrap-${BOOTSTRAP_VERSION}/scss scss/bootstrap
	cp -r bootstrap/bootstrap-${BOOTSTRAP_VERSION}/dist/js/bootstrap.bundle.min.js public/js/
	rm -rf bootstrap
	rm -rf v${BOOTSTRAP_VERSION}.zip

scss: 
	vendor/bin/pscss -s compressed scss/app.scss > public/css/app.css