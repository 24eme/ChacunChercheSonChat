#!/bin/bash

cd $(dirname $0)

cat | awk '{print $3","$6","$8","$10","$12 $13 $14}' | python predict.py
