# `RecursiveDirectoryIterator` WSL2 Bug

This repository demonstrates a bug when using the `RecursiveDirectoryIterator` in PHP in a docker container running on Docker for Desktop in Windows 10 using the WSL2 Engine.

## Reproduction Steps

* Windows 10 Pro
* Version 2004
* OS build 19041.546
* Docker Desktop 2.4.0.0 (48506)

```bash
git clone https://github.com/themizzi/wsl2-php-recursive-directory-iterator-bug.git
cd wsl2-php-recursive-directory-iterator-bug
docker-compose run php php test.php
```

## Expected Result

file counts should never diverge and program should exit after `$stop`

## Actual Result

file counts diverge from `scandir` after 65 files.
