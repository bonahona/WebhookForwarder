cd ../../docker
docker-compose build webhook-forwarder-site
docker-compose up -d webhook-forwarder-site
cd ../sites/WebhookForwarder