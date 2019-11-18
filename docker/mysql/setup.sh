#!/bin/bash
set -e
service mysql start
mysqladmin create stock_2_shop
#service mysql stop
