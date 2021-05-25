#!/bin/bash
set -u
FROM_ID=1
TO_ID=""
while (( "$#" )); do
  case "$1" in
    -f|--from_id)
      FROM_ID=$2
      shift 2
      ;;
    -t|--to_id)
      TO_ID=$2
      shift 2
      ;;
    --) # end argument parsing
      shift
      break
      ;;
    -*|--*=) # unsupported flags
      echo "Error: Unsupported flag $1" >&2
      exit 1
      ;;
  esac
done

NUMBER='^[0-9]+$'
if ! [[ $FROM_ID =~ $NUMBER ]]; then
  echo "Error: From ID is required and must be a number" >&2; exit 1
fi

if ! [[ $TO_ID =~ $NUMBER ]]; then
  echo "Error: To ID is required and must be a number" >&2; exit 1
fi;

AUTO_INCREMENT=$(($TO_ID + 1));

SCRIPT_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

DB_PREFIX="$(${SCRIPT_PATH}/vendor/bin/wp db prefix | paste -s -d, -)"

USER_EXITS=$(${SCRIPT_PATH}/vendor/bin/wp db query "SELECT ID FROM ${DB_PREFIX}users WHERE ID = ${FROM_ID};" | paste -s -d, -)

if [ -z "$USER_EXITS" ]; then
    echo "User with ID ${FROM_ID} does not exits."
    exit 1
fi

${SCRIPT_PATH}/vendor/bin/wp db query "UPDATE ${DB_PREFIX}users SET ID = ${TO_ID} WHERE ID = ${FROM_ID};"
${SCRIPT_PATH}/vendor/bin/wp db query "ALTER TABLE ${DB_PREFIX}users AUTO_INCREMENT=${AUTO_INCREMENT};"
${SCRIPT_PATH}/vendor/bin/wp db query "UPDATE ${DB_PREFIX}usermeta SET user_id = ${TO_ID} WHERE user_id = ${FROM_ID};"
${SCRIPT_PATH}/vendor/bin/wp db query "UPDATE ${DB_PREFIX}posts SET post_author = ${TO_ID} WHERE post_author = ${FROM_ID};"

echo "Updated, new auto increment: ${AUTO_INCREMENT}."
