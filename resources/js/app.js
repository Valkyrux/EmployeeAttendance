require('./bootstrap');

require('axios');

axios.get('http://127.0.0.1:8000/api/v1/attendances')
    .then(function (response) {
        const dataSet = response.data.result;
        console.log(response.data.result);
        $(document).ready(function () {
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
    });

let dynamicTable;

axios.get('http://127.0.0.1:8000/api/v1/weekly?date=20-12-05')
    .then(function (response) {
        const dataSet = response.data.result;
        
        $(document).ready(function () {
            dynamicTable = $('#myTable2').DataTable({
                data: dataSet.body,
                columns: dataSet.columns
            });
        });
    })
    .catch(function (error) {
        console.log(error);
    });

const dateInput = document.getElementById("dateInput");
dateInput.addEventListener('change', () => {
    dynamicTable.destroy();
    axios.get('http://127.0.0.1:8000/api/v1/weekly', {
        params: {
          date: dateInput.value
        }
      })
    .then(function (response) {
        const dataSet = response.data.result;
        $(document).ready(function () {
            dynamicTable = $('#myTable2').DataTable({
                data: dataSet.body,
                columns: dataSet.columns
            });
        });
    })
    .catch(function (error) {
        console.log(error);
    });
});
