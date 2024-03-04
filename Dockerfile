FROM php:7.2-apache

EXPOSE 80

#COPY ./prusa /opt/prusa/
RUN apt-get -y update
RUN apt-get -y install libgtk2.0-dev libwxgtk3.0-dev libwx-perl libmodule-build-perl git cpanminus libextutils-cppguess-perl libboost-all-dev libxmu-dev liblocal-lib-perl wx-common libopengl-perl libwx-glcanvas-perl libtbb-dev libxmu-dev freeglut3-dev libwxgtk-media3.0-dev libboost-thread-dev libboost-system-dev libboost-filesystem-dev libcurl4-openssl-dev cron wget
RUN echo "/etc/init.d/apache2 start" >> /root/.bashrc

RUN wget https://github.com/prusa3d/PrusaSlicer/releases/download/version_2.7.2/PrusaSlicer-2.7.2+linux-x64-GTK3-202402291307.tar.bz2 -O /tmp/prusa.tar.bz2
RUN mkdir -p /opt/prusa
RUN tar xf /tmp/prusa.tar.bz2 -C /opt/prusa
RUN rm /tmp/prusa.tar.bz2

ADD clean.sh /root/clean.sh
RUN chmod +x /root/clean.sh
RUN crontab -l | { cat; echo "0 0 * * * bash /root/clean.sh"; } | crontab -

ADD ./app /var/www/html
RUN mkdir -p /var/www/html/files