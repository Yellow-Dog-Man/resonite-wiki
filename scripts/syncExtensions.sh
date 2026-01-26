#!/bin/bash

REF="REL1_45"

if [ -z "$1" ]; then
    echo "Usage: $0 <extension-list-file>"
    exit 1
fi

while IFS= read -r line || [ -n "$line" ]; do
    [[ -z "$line" || "$line" =~ ^[[:space:]]*# ]] && continue

    read -r path url <<< "$line"

    # blank lines
    if [ -z "$path" ] || [ -z "$url" ]; then
        continue
    fi

    # Check if submodule already exists
    if git config --file .gitmodules --get "submodule.$path.url" &>/dev/null; then
        # already exists skip
        continue
    else
        echo "Adding submodule: $path from $url"
        git submodule add "$url" "$path"
    fi

    # Always attempt to checkout the target ref
    if [ -d "$path" ]; then
        echo "Checking out $REF for $path..."
        (cd "$path" && git checkout "$REF" 2>/dev/null)
    fi
done < "$1"

echo "Done!"