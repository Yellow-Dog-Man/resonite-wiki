# Resonite Wiki

A collection of files required to spin up the Resonite Wiki. 

> WIP Right now. Feel free to observe, but let me cook - prime.

## Goals
1. Open Source 
   - Except for Secrets of Course
2. Fully Documented
3. Avoid Modifying the Containers at runtime.
4. Proper Secret Management
5. Resolving [All public issues involving the wiki](https://github.com/Yellow-Dog-Man/Resonite-Issues/issues?q=state%3Aopen%20label%3A%22Wiki%22)


## Context
Our current wiki(wiki.resonite.com) is running an older setup that mixes Docker hosting with extensive editing and tweaking of the Docker container. As changes to docker containers at runtime are difficult to persist and prevent operations like rebuilding a container etc. this old setup is being replaced with the contents of this repository.

You can read more about this in a bunch of GitHub Issues:
- [Internal Issue](https://github.com/Yellow-Dog-Man/InternalDiscussion/issues/683)
- [All public issues involving the wiki](https://github.com/Yellow-Dog-Man/Resonite-Issues/issues?q=state%3Aopen%20label%3A%22Wiki%22)

## Files
- extensions/
   - Contains all our Mediawiki Extensions. These are Git Submodules
- skins/
   - Contains all our Skins. These are git Submodules
- docker-compose.yaml
   - Compose file that sets everything up
- Dockerfile
   - Contains our custom dockerfile for the mediawiki installation.
   - This can bake Extensions and skins into the docker container, avoiding the overhead and creating a stable image
- config
   - A collection of configuration files, managed and linked into the container
   - LocalSettings.php is linked into the container via docker in the usual mechanism.
   - Orchestrated for separation of concerns and maintenance
   - Feel free to re-organize this, the initial split is arbitrary.
- scripts
   - Helpful scripts to handle some automated tasks.


# Backups
When the docker compose profile backups is include in startup: `docker compose up --profile backups`:

1. Every day at 12:00AM server time, an automated MySQL backup is performed.
   - This creates a tarbell of the database
1. Every day at 01:00PM server time, an automated script runs, backing up the image folders
1. Once both are complete they are synced to a Cloudflare R2 Bucket

## Bucket Configuration
- Bucket Name: wiki-backups
- Lifecycle policies:
   - Transition to Long Term storage after 5 days
   - Delete after 1 year.


## Commands
- `docker compose up` - starts up everything with defaults
- `docker compose up --profile backups`

## Resources
- https://www.mediawiki.org/wiki/MediaWiki-Docker
- https://gerrit.wikimedia.org/r/plugins/gitiles/mediawiki/core/+/HEAD/docker-compose.yml
- https://docs.docker.com/compose/how-tos/multiple-compose-files/extends/
- https://hub.docker.com/layers/starcitizentools/mediawiki/smw-jobrunner-latest
- https://github.com/wikimedia/mediawiki-docker?tab=readme-ov-file
- https://github.com/wikimedia/mediawiki-docker/blob/main/1.45/apache/Dockerfile
- https://github.com/selim13/docker-automysqlbackup
- https://hub.docker.com/r/instrumentisto/restic
- https://github.com/openmrs/openmrs-contrib-docker-cron-backup
- https://github.com/robbyoconnor/openmrs-contrib-docker-cron-backup TODO: we should make our own fork, this thing is really cooool!
- https://www.compilenrun.com/docs/devops/docker/docker-storage/docker-volume-drivers/#4-azure-file-storage-driver
- https://dev.to/chattes/s3-as-docker-volumes-3bkd + Cloudflare R2
- https://github.com/rexray/rexray
- https://www.mediawiki.org/wiki/Manual:Upgrading

