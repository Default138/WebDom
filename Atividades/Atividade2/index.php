<?php

require_once("modelo/link.php");

function desenhaBotao(string $nomeBotao = "botao", array $itemsBotao = array())
{
    echo "<div class='dropdown'>";
    echo "<button class='dropbtn'>" . $nomeBotao . "</button>";
    echo "<div class='dropText'>";
    foreach ($itemsBotao as $item) {
        print "<span><img src='" . $item->getLinkImg() . "' width='100' height=100'>" . $item->getInfo() . "</span>";
    }
    echo "</div>";
    echo "</div>";
}

$bandas = array(
    new Link("https://imgs.search.brave.com/KWgyy5Xazgal7QLgr0y38-N7LKpuYIMdLrDTo9VkgNc/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9ibG9n/LmxvZ29teXdheS5j/b20vd3AtY29udGVu/dC91cGxvYWRzLzIw/MjEvMDgvQUNEQy1M/b2dvLXJlZC5qcGc", "AC/DC"),
    new Link("https://imgs.search.brave.com/z-XQOALiUeLun_ngbC93YIDzrA1IkhaxrUIcGFYicN4/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jZG4u/d2FsbHBhcGVyc2Fm/YXJpLmNvbS80NC85/MS9xQWh5b1AuanBn", "Gun's N Roses"),
    new Link("https://imgs.search.brave.com/PCCcwx2Dtvxvfoemi4CkIM5ZRncP0UlxM290rkPG85c/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pLnBp/bmltZy5jb20vb3Jp/Z2luYWxzL2I0LzBi/LzFhL2I0MGIxYWNk/ZjdjNjc5YWMzZWEw/YzVmOTA0NTBmNjZh/LmpwZw", "Kaleo")
);

$times = array(
    new Link("https://imgs.search.brave.com/x-8glMDpJvquenXgO5tNLZO5_I3rj7D4cjFTnc45bsM/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9sb2dv/ZG93bmxvYWQub3Jn/L3dwLWNvbnRlbnQv/dXBsb2Fkcy8yMDE1/LzA1L3BhbG1laXJh/cy1sb2dvLTExLnBu/Zw", "Palmeiras"),
    new Link("https://imgs.search.brave.com/qhNsaY4qio1eiRB5bvg87frPlsuY0DNCrRYFBrLzxZc/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly93d3cu/ZnJlZXBuZ2xvZ29z/LmNvbS91cGxvYWRz/L2xvZ28tZmxhbWVu/Z28tcG5nL2ZsYW1l/bmdvLWxvZ28tMC5w/bmc", "Flamnego"),
    new Link("https://imgs.search.brave.com/tfHqPaem8IKEkSiEDPg07ncmKXpFskxfr6Cpwg663tA/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly8xMDAw/bG9nb3MubmV0L3dw/LWNvbnRlbnQvdXBs/b2Fkcy8yMDE4LzA3/L0ludGVyLU1pbGFu/LUxvZ28tMTkwOC01/MDB4MjgyLnBuZw", "Iter")
);

$carros = array(
    new Link("https://imgs.search.brave.com/UZf278iNldC_MFk1erj9iCbBj3EPEkL7Uo_tFPxcMmk/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9vbmx5/Y2Fycy5jb20uYnIv/d3AtY29udGVudC91/cGxvYWRzLzIwMjMv/MDUvc2F2ZWlyby1n/My1zdW1tZXItcmVi/YWl4YWRhLmpwZw", "Saveiro"),
    new Link("https://imgs.search.brave.com/jgNR4swLndsxE0kwR9mMCtUPPcdKFs63-oH_iEiXH2M/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93d3cu/Y2Fycm9zZHViLmNv/bS5ici9mb3Rvcy8y/MDIxLzA0LWphbi0y/MS9hc3RyYS1zZWRh/bi12b2xjYW5vc3Mt/YXJvMTgtMDEuanBn", "Astra"),
    new Link("https://imgs.search.brave.com/ykAhcgoWB9N68al88wHGF53VpEME442n_diRAiqleu0/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9vbmx5/Y2Fycy5jb20uYnIv/d3AtY29udGVudC91/cGxvYWRzLzIwMjQv/MDgvZ29sZi1zYXBh/by1tazQtcmViYWl4/YWRvLXByYXRhLmpw/Zw", "Golf")
);

$pokemon = array(
    new Link("https://imgs.search.brave.com/cuFdmsFHDjHowrvWYKnkijjBLQGroHPg9H-DMnZLLWs/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9pbWFn/ZXMucGV4ZWxzLmNv/bS9waG90b3MvMTcx/Njg2MS9wZXhlbHMt/cGhvdG8tMTcxNjg2/MS5qcGVnP2F1dG89/Y29tcHJlc3MmY3M9/dGlueXNyZ2ImZHBy/PTEmdz01MDA", "Pikachu"),
    new Link("https://imgs.search.brave.com/GcAwdnngoeRoHPm_teCT6Qf9MJUQFPTS3Wghn8xApKQ/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly93YWxs/cGFwZXJzLmNvbS9p/bWFnZXMvaGQvZ2xv/b215LWhhdW50ZXIt/MzdnczB3ZjB0ZTR1/ZGlpMi5qcGc", "Haunter"),
    new Link("https://imgs.search.brave.com/vSrv9LqqCuTN0thAo1DKzTWv07jRIcrDk2OY4QbbJGg/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9zMS56/ZXJvY2hhbi5uZXQv/QXJib2suNjAwLjM2/MTY5NC5qcGc", "Arbok")
);

print "<link rel='stylesheet' href='botao_imagem.css'>";

desenhaBotao("Bandas", $bandas);
desenhaBotao("Times", $times);
desenhaBotao("Carros", $carros);
desenhaBotao("Pokémon", $pokemon);