BOOTSTRAP_VERSION:=5.3.3
BOOTSTRAP_ICON_VERSION:=1.11.3
JQUERY_VERSION:=3.7.1

.PHONY: assets scss

assets:
	mkdir -p public/css
	mkdir -p public/js
	mkdir -p public/img
	mkdir -p scss/libs

	wget https://github.com/twbs/icons/releases/download/v${BOOTSTRAP_ICON_VERSION}/bootstrap-icons-${BOOTSTRAP_ICON_VERSION}.zip
	wget https://github.com/twbs/bootstrap/archive/v${BOOTSTRAP_VERSION}.zip
	wget https://code.jquery.com/jquery-${JQUERY_VERSION}.slim.min.js -O public/js/jquery.slim.min.js

	unzip -d bootstrap v${BOOTSTRAP_VERSION}.zip
	cp -r bootstrap/bootstrap-${BOOTSTRAP_VERSION}/scss scss/libs/bootstrap
	cp -r bootstrap/bootstrap-${BOOTSTRAP_VERSION}/dist/js/bootstrap.bundle.min.js public/js/
	rm -rf bootstrap
	rm -rf v${BOOTSTRAP_VERSION}.zip

	unzip bootstrap-icons-${BOOTSTRAP_ICON_VERSION}.zip
	cp bootstrap-icons-${BOOTSTRAP_ICON_VERSION}/font/bootstrap-icons.scss scss/libs/
	cp -r bootstrap-icons-${BOOTSTRAP_ICON_VERSION}/font/fonts public/css/
	rm -rf bootstrap-icons-${BOOTSTRAP_ICON_VERSION}
	rm -rf bootstrap-icons-${BOOTSTRAP_ICON_VERSION}.zip


scss:
	vendor/bin/pscss -s compressed scss/app.scss > public/css/app.css

