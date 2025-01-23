#!/bin/sh

# Set variables for the backup
TIMESTAMP=$(date +'%Y-%m-%d_%H-%M-%S')
BACKUP_DIR="/backups"
DB_HOST="db"
DB_USER="admin"
DB_PASSWORD="Admin123!"
DB_NAME="twitterclone"

# Create a backup
mysqldump -h $DB_HOST -u $DB_USER -p$DB_PASSWORD $DB_NAME > "$BACKUP_DIR/twitterclone_$TIMESTAMP.sql"

# Remove backups older than 7 days
find $BACKUP_DIR -type f -name "twitterclone_*.sql" -mtime +7 -exec rm {} \;
