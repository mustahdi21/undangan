const stats=[['Undangan Dibuat','128K+'],['Tamu Diundang','4.2M+'],['Tema Tersedia','250+'],['User Aktif','38K+']];
const root=document.querySelector('#stats');
if(root){root.innerHTML=stats.map(([k,v])=>`<div class="glass p-4 rounded-2xl"><p class="text-sm text-slate-300">${k}</p><h4 class="text-2xl font-bold">${v}</h4></div>`).join('');}
