require('./bootstrap');

require('axios');

axios.get('http://127.0.0.1:8000/api/v1/attendances')
  .then(function (response) {
      const dataSet = response.data.result;
      console.log(response.data.result);
      $(document).ready( function () {
        $('#myTable').DataTable({
            data: dataSet,
            columns: [
                { title: "Dipendente" },
                { title: "Ingresso" },
                { title: "Uscita" },
                { title: "Durata" },
            ]
        });
    });
  })
  .catch(function (error) {
    console.log(error);
  })

axios.get('http://127.0.0.1:8000/api/v1/weekly?date=20-12-05')
  .then(function (response) {
      const dataSet = response.data.result;
      console.log(dataSet.columns);
      $(document).ready( function () {
        $('#myTable2').DataTable({
            data: dataSet.body,
            columns: dataSet.columns
        });
    });
  })
  .catch(function (error) {
    console.log(error);
  })


