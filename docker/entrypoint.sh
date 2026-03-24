#!/usr/bin/env bash
set -e

DB_HOST_VALUE="${DB_HOST:-db}"
DB_PORT_VALUE="${DB_PORT:-3306}"
DB_USER_VALUE="${DB_USER:-cake}"
DB_PASSWORD_VALUE="${DB_PASSWORD:-cake}"
DB_NAME_VALUE="${DB_NAME:-utm_test}"

attempt=0
max_attempts=60

echo "Waiting for MySQL at ${DB_HOST_VALUE}:${DB_PORT_VALUE}..."

until DB_HOST_VALUE="$DB_HOST_VALUE" \
      DB_PORT_VALUE="$DB_PORT_VALUE" \
      DB_USER_VALUE="$DB_USER_VALUE" \
      DB_PASSWORD_VALUE="$DB_PASSWORD_VALUE" \
      DB_NAME_VALUE="$DB_NAME_VALUE" \
      php -r '
$host = getenv("DB_HOST_VALUE");
$port = (int)getenv("DB_PORT_VALUE");
$user = getenv("DB_USER_VALUE");
$pass = getenv("DB_PASSWORD_VALUE");
$db   = getenv("DB_NAME_VALUE");
$mysqli = @new mysqli($host, $user, $pass, $db, $port);
if ($mysqli->connect_errno) {
    exit(1);
}
$mysqli->close();
exit(0);
'; do
  attempt=$((attempt + 1))

  if [ "$attempt" -ge "$max_attempts" ]; then
    echo "MySQL is still unavailable after ${max_attempts} attempts."
    exit 1
  fi

  sleep 2
done

echo "MySQL is ready. Starting Apache..."
exec "$@"
