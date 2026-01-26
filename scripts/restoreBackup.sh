#!/bin/sh

set -e

# Wait for database to be ready
echo "[$(date)] Waiting for database connection..."
until mysql -h resonite-wiki-database -u root -p"$(cat /run/secrets/mysql_root_password)" -e "SELECT 1" wiki_db 2>/dev/null >/dev/null; do
  echo "[$(date)] Database not ready, waiting..."
  sleep 2
done
echo "[$(date)] Database Ready"

# Check if database is seeded
if mysql -h resonite-wiki-database -u root -p"$(cat /run/secrets/mysql_root_password)" -e "SELECT 1 FROM user LIMIT 1" wiki_db 2>/dev/null >/dev/null; then
  echo "[$(date)] Database already seeded, skipping restore"
else
  LATEST_FILE=$(rclone ls "r2:${R2_BACKUP_BUCKET_NAME}/database-backups/latest/" | awk '{print $2}')

  if [ -n "$LATEST_FILE" ]; then
    echo "[$(date)] Restoring database from $LATEST_FILE"
    rclone cat "r2:${R2_BACKUP_BUCKET_NAME}/database-backups/latest/$LATEST_FILE" | gunzip | mysql -h resonite-wiki-database -u root -p"$(cat /run/secrets/mysql_root_password)" wiki_db
    echo "[$(date)] Database restore completed"
  else
    echo "[$(date)] No latest backup found"
  fi
fi
