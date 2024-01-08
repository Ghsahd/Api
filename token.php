<?php

$jwtSecret = bin2hex(random_bytes(32));
echo "JWT Secret: $jwtSecret\n";
