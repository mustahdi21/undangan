AOS.init({duration:900,once:true});
window.addEventListener('load',()=>document.getElementById('loader')?.remove());
const cd=document.getElementById('countdown');
setInterval(()=>{const d=new Date(APP.eventDate)-new Date();const s=Math.max(0,Math.floor(d/1000));const v=[Math.floor(s/86400),Math.floor(s%86400/3600),Math.floor(s%3600/60),s%60];cd.innerHTML=['Hari','Jam','Menit','Detik'].map((l,i)=>`<div class='glass rounded-xl p-3'><div class='text-2xl font-bold'>${v[i]}</div><div class='text-xs'>${l}</div></div>`).join('')},1000);
const music=document.getElementById('bgMusic');document.getElementById('musicToggle')?.addEventListener('click',()=>{if(music.paused){music.play();event.target.textContent='Pause Music'}else{music.pause();event.target.textContent='Play Music'}});
for(const b of document.querySelectorAll('.copy-btn'))b.onclick=async()=>{await navigator.clipboard.writeText(b.dataset.copy);b.textContent='Copied!';setTimeout(()=>b.textContent='Copy',1200)};
document.getElementById('rsvpForm')?.addEventListener('submit',async(e)=>{e.preventDefault();const fd=new FormData(e.target);const r=await fetch('api/rsvp',{method:'POST',body:fd});document.getElementById('rsvpResult').textContent=(await r.json()).message;});
setInterval(async()=>{const r=await fetch('api/wishes');const data=await r.json();const box=document.getElementById('wishes');box.innerHTML=data.map(w=>`<div class='glass p-3 rounded-xl'><b>${w.guest_name}</b><p>${w.message}</p></div>`).join('')},8000);
if('serviceWorker'in navigator)navigator.serviceWorker.register('/service-worker.js');
