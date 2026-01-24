#!/bin/sh

echo "Starting entrypoint..."
/usr/local/bin/restoreBackup.sh
echo "restoreBackup.sh finished with exit code $?"

echo "Executing CMD: $@"
exec "$@"
