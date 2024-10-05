<script>
    function validate_outOfStock(name, available) {
        var flag = 0;
        var udata = sessionStorage.getItem('user_data');
        var parsedData = JSON.parse(udata);
        if (parsedData) {

            for (var key in parsedData) {

                if (parsedData.hasOwnProperty(key)) {

                    if (key == name) {
                        
                        var avg = MinAverage(parsedData, key);
                        console.log("avg" + avg);
                        console.log("available" + available);
                        if (available < avg) {
                            flag = 1;
                            return flag;
                        }
                    }

                }
            }

        }
        return flag;
    }

    function MinAverage(parsedData, key) {

        var avg;
        avg = parseInt(E(parsedData, key) / TotalSales(parsedData, key));
        console.log("average is:" + avg);
        return avg;
    }

    function E(QPS, key) {
        var sum = 0;
        for (var value of QPS[key]) {
            value = parseInt(value);
            sum += value;
        }
        return sum;
    }

    function TotalSales(parsedData, key) {
        count = 0;
        for (var value of parsedData[key]) {
            count++;
        }
        return count;
    }
</script>