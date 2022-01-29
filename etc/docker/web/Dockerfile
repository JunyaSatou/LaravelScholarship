FROM nginx:1.15.0

ARG APP_ENV
ARG SET_REAL_IP_FROM
ARG SERVER_NAME
ENV APP_ENV=$APP_ENV
ENV SET_REAL_IP_FROM=$SET_REAL_IP_FROM
ENV SERVER_NAME=$SERVER_NAME

RUN apt-get update \
  && apt-get install -y vim curl \
  && apt-get clean \
  && rm -Rf /var/lib/apt/lists/*

ENV LANG C.UTF-8
WORKDIR /var/www/html

COPY .vimrc /root/.vimrc
COPY nginx.conf /etc/nginx/nginx.conf
COPY conf.d/${APP_ENV}.conf /etc/nginx/conf.d/
RUN rm /etc/nginx/conf.d/default.conf

RUN if [ "$APP_ENV" = 'development' -o "$APP_ENV" = 'production' ]; then \
      sed -i "s%127.0.0.1%$SET_REAL_IP_FROM%" /etc/nginx/nginx.conf; \
  fi

RUN if [ -n "$SERVER_NAME" ]; then \
      sed -i "s%localhost%$SERVER_NAME%" /etc/nginx/conf.d/${APP_ENV}.conf; \
  fi

COPY docker-entrypoint.sh /bin/docker-entrypoint.sh
CMD ["/bin/docker-entrypoint.sh"]
