# Build docker: docker build --tag sraleik/mon_cv .
# Run:  docker run -d -p 80:80 -e ALLOW_OVERRIDE=true -v /var/run/mysqld/mysqld.sock:/var/run/mysqld/mysqld.sock --name mon_cv sraleik/mon_cv
# Run en dev:  docker run -d -p 80:80 -e ALLOW_OVERRIDE=true -e GIT_COMMIT=dev -v (pwd):/app --name mon_cv sraleik/mon_cv

FROM       sraleik/x64-apache:trusty

RUN apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get -yq install \
        nodejs && \
    rm -rf /var/lib/apt/lists/*

RUN ln -s /usr/bin/nodejs /usr/local/bin/node

RUN curl -L https://npmjs.org/install.sh | sh

RUN rm -rf /app

WORKDIR /

RUN git clone https://github.com/Pibolo/pibolo.github.io.git app

WORKDIR /app

RUN php composer.phar install --no-interaction
RUN npm install

ADD run.sh /run.sh

EXPOSE 80

ENTRYPOINT ["bash"]

CMD ["-l", "/run.sh"]
