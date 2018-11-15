# Admin Panel of Grupo Tesseract

Made with [InfyOm Laravel Generator](http://labs.infyom.com/laravelgenerator/).

## Requirements

- **Install [Docker](https://docs.docker.com/install/)**
- **Install [Docker Compose](https://docs.docker.com/compose/install/)**

The Rest of the tools will run from inside the containers.

## Setup

```
# Start Vessel and prepare the environment:

cp .env.example .env
./vessel start
./vessel comp install
./vessel art key:generate
./vessel art migrate --seed

# Prepare de Assets
./vessel yarn
./vessel yarn run watch
```

**Access [http://localhost](http://localhost)**

## Useful Tools and Links

- [Vessel](https://vessel.shippingdocker.com/)
- [Laravel Generator](http://labs.infyom.com/laravelgenerator/)
- [Postman](https://www.getpostman.com/)
- [JSON API](https://jsonapi.org/)
- [Eloquent: API Resources](https://laravel.com/docs/5.7/eloquent-resources)
