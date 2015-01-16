#!/bin/bash
git add --all 
git commit -m "daily update"
git push
git-ftp push
git ftp init -u winardiaris -p - ftp://simabes.winardiaris.koding.io/Web/simabes/

