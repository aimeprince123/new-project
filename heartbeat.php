<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Heartbeat Monitoring Dashboard</title>
<style>
*{box-sizing:border-box}
body{margin:0;padding:32px;background:#101827;color:#f8fafc;font-family:Arial,sans-serif;text-align:center}
main{max-width:760px;margin:30px auto}
.card{background:#1e293b;border:1px solid #334155;border-radius:18px;padding:32px}
.heart{font-size:76px;color:#fb4964;animation:beat 1s infinite}
@keyframes beat{0%,100%{transform:scale(1)}50%{transform:scale(1.16)}}
#bpm{font-size:72px;font-weight:bold;color:#22c55e;margin:12px}
.unit{color:#cbd5e1}
.status{margin:20px auto;padding:12px;border-radius:10px;background:#334155}
.time{color:#94a3b8;font-size:14px}
.note{color:#cbd5e1;font-size:13px;line-height:1.5;margin-top:22px}
</style>
</head>
<body>
<main>
  <h1>Heartbeat Monitoring System</h1>
  <div class="card">
    <div class="heart" aria-hidden="true">♥</div>
    <h2>Heart Rate</h2>
    <div id="bpm">--</div>
    <div class="unit">Beats Per Minute (BPM)</div>
    <div class="status" id="status" role="status">Waiting for sensor data...</div>
    <div class="time" id="time">No reading received yet</div>
  </div>
  <p class="note">This is an educational monitoring dashboard, not a medical device. Do not use it as the only way to detect or respond to a medical emergency.</p>
</main>
<script>
async function refreshReading(){
  const status = document.getElementById('status');
  try{
    const response = await fetch('latest_reading.php', {cache:'no-store'});
    if(!response.ok) throw new Error('Server returned '+response.status);
    const data = await response.json();
    const bpm = Number(data.bpm);
    document.getElementById('bpm').textContent =
      Number.isFinite(bpm) && bpm > 0 ? bpm : '--';
    document.getElementById('time').textContent =
      data.created_at || 'No reading received yet';
    status.textContent =
      Number.isFinite(bpm) && bpm > 0
        ? (bpm <= 40 ? 'LOW READING — check the person and verify the measurement' : 'Receiving heartbeat readings')
        : 'Waiting for sensor data...';
  }catch(error){
    status.textContent = 'Could not load readings. Check PHP and database.';
  }
}
refreshReading();
setInterval(refreshReading, 2000);
</script>
</body>
</html>
