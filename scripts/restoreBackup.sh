#!/bin/sh

# Check if database is seeded 
if mysql -h resonite-wiki-database -u "$(cat /run/secrets/db_user)" -p"$(cat /run/secrets/db_password)" -e "SELECT 1 FROM user LIMIT 1" wiki_db 2>/dev/null >/dev/null; then
  echo "[$(date)] Database already seeded, skipping restore"
  exit 0
fi

LATEST_FILE=$(rclone ls "r2:${R2_BACKUP_BUCKET_NAME}/database-backups/latest/" | awk '{print $3}')

if [ -n "$LATEST_FILE" ]; then
  echo "[$(date)] Restoring database from $LATEST_FILE"
  rclone cat "r2:${R2_BACKUP_BUCKET_NAME}/database-backups/latest/$LATEST_FILE" | gunzip | mysql -h resonite-wiki-database -u "$(cat /run/secrets/db_user)" -p"$(cat /run/secrets/db_password)" wiki_db
  echo "[$(date)] Database restore completed"
else
  echo "[$(date)] No latest backup found"
fi
