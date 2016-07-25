#!/bin/bash
# chown www-data:www-data /app -R

cd /app
if [ ${GIT_COMMIT} != 'dev' ]
then
    git pull origin $GIT_COMMIT \
    && git checkout $GIT_COMMIT
    php composer.phar update
fi

if [ "$ALLOW_OVERRIDE" = "true" ]; then
    sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf
    a2enmod rewrite
else
    unset ALLOW_OVERRIDE
fi

source /etc/apache2/envvars
tail -F /var/log/apache2/* &
exec apache2 -D FOREGROUND
