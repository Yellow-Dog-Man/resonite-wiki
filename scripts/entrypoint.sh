#!/bin/sh

echo "Starting entrypoint..."
/usr/local/bin/restoreBackup.sh
exit_code=$?
if [ $exit_code -ne 0 ]; then
    echo "restoreBackup.sh failed with exit code $exit_code"
    exit $exit_code
fi
echo "restoreBackup.sh finished successfully."


echo "Executing CMD: $@"
exec "$@"
