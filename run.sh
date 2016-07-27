#!/bin/bash
# chown www-data:www-data /app -R

if [ "$ALLOW_OVERRIDE" = "true" ]; then
    sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf
    a2enmod rewrite
else
    unset ALLOW_OVERRIDE
fi

cd /app
if [ ${GIT_COMMIT} != 'dev' ]
then
    git pull origin $GIT_COMMIT \
    && git checkout $GIT_COMMIT
fi

php composer.phar update
npm install


if [ ${GIT_COMMIT} = 'dev' ]
then
    service apache2 start
    npm run watch
else
    source /etc/apache2/envvars
    tail -F /var/log/apache2/* &
    exec apache2 -D FOREGROUND
fi
