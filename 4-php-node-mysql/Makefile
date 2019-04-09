PHP=eval "docker-compose -f php/docker-compose.yml"
NODE=eval "docker-compose -f node/docker-compose.yml"
up:
	${PHP} up --build -d
	${NODE} up --build -d

stop:
	${PHP} stop
	${NODE} stop

purge:
	${PHP} stop
	${NODE} stop
	${PHP} rm -f -v
	${NODE} rm -f -v
