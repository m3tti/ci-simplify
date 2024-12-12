BOOTSTRAP_VERSION:="5.3.3"
BOOTSTRAP_ICON_VERSION:="1.11.3"
JQUERY_VERSION:="3.7.1"

assets:
	mkdir -p public/css
	mkdir -p public/js
	mkdir -p public/img
	wget https://cdn.jsdelivr.net/npm/bootstrap@${BOOTSTRAP_VERSION}/dist/css/bootstrap.min.css -O public/css/bootstrap.min.css
	wget https://cdn.jsdelivr.net/npm/bootstrap@${BOOTSTRAP_VERSION}/dist/js/bootstrap.bundle.min.js -O public/js/bootstrap.bundle.min.js
	wget https://cdn.jsdelivr.net/npm/bootstrap-icons@${BOOTSTRAP_ICON_VERSION}/font/bootstrap-icons.min.css -O public/css/bootstrap-icons.min.css
	wget https://code.jquery.com/jquery-${JQUERY_VERSION}.min.js -O public/js/jquery.min.js