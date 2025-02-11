<!DOCTYPE html>
<html>
<head>
    <title>Log MQTT</title>
</head>
<body>
    <div id="mqtt-log">
        <h2>MQTT Logs</h2>
        <div id="log-content"></div>
    </div>

    <script>
        function fetchMqttData() {
            fetch('/mqtt/log')
                .then(response => response.json())
                .then(data => {
                    let logContent = document.getElementById('log-content');
                    logContent.innerHTML = data.messages.join('<br>');
                })
                .catch(error => console.log('Error fetching MQTT data:', error));
        }

        // Poll every 1 second
        setInterval(fetchMqttData, 1000);
    </script>
</body>
</html>