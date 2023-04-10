# https://stackoverflow.com/questions/66578506/where-is-the-pgpass-file-in-pgadmin4-docker-container-when-this-file-is-mounted/69258794#69258794
FROM dpage/pgadmin4
USER pgadmin
RUN mkdir -p  /var/lib/pgadmin/storage/sail_example.co.jp
COPY .pgadmin4/pgpass /var/lib/pgadmin/storage/sail_example.co.jp/
USER root
RUN chown 5050:5050 /var/lib/pgadmin/storage/sail_example.co.jp/pgpass
RUN chmod 0600 /var/lib/pgadmin/storage/sail_example.co.jp/pgpass
USER pgadmin
ENTRYPOINT ["/entrypoint.sh"]