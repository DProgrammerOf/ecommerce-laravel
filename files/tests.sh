output_tests=$(php artisan test)
if [ $(echo "$output_tests" | grep -c "FAILED") -eq 0 ]; then
    echo "Tests Ok!"
else
    echo -e "$output_tests"
fi