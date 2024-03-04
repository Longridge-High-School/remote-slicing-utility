FROM php:7.2-apache

EXPOSE 80

COPY ./prusa /opt/prusa/
RUN apt-get -y update && apt-get -y install libgtk2.0-dev libwxgtk3.0-dev libwx-perl libmodule-build-perl git cpanminus libextutils-cppguess-perl libboost-all-dev libxmu-dev liblocal-lib-perl wx-common libopengl-perl libwx-glcanvas-perl libtbb-dev libxmu-dev freeglut3-dev libwxgtk-media3.0-dev libboost-thread-dev libboost-system-dev libboost-filesystem-dev libcurl4-openssl-dev cron
RUN echo "/etc/init.d/apache2 start" >> /root/.bashrc

ADD clean.sh /root/clean.sh
RUN chmod +x /root/clean.sh
RUN crontab -l | { cat; echo "0 0 * * * bash /root/clean.sh"; } | crontab -

# COPY ./app /var/www/html # Uncomment to build files into image.
# RUN mkdir /var/www/html/files # Uncomment to build files into image.

CMD "cron;/etc/init.d/apache2 restart;bash"