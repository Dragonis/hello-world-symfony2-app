#!/bin/bash

if [ `hostname` != "abc" ];
then
    echo The command should be executed in the guest OS!
    exit 1
fi

./reload.bash
./bin/behat

