<?php
/*
 * Queries
 *
 * Р С™Р В»Р В°РЎРѓ Р Т‘Р В»РЎРЏ Р С—Р С•Р В»РЎС“РЎвЂЎР ВµР Р…Р С‘РЎРЏ sql РЎРѓ Р С‘РЎвЂ¦ Р С—РЎР‚Р С•РЎРѓРЎвЂљР С•Р в„– Р С•Р В±РЎР‚Р В°Р В±Р С•РЎвЂљР С”Р С•Р в„–
 */
class Queries {
    // Р С—Р С•Р В»РЎС“РЎвЂЎР С‘РЎвЂљРЎРЉ РЎС“РЎР‚Р В»РЎвЂ№ Р С‘ Р С—Р С•Р В·Р С‘РЎвЂ Р С‘Р С‘ Р Т‘Р В»РЎРЏ Р С”Р С•Р Р…Р С”Р ВµРЎР‚РЎвЂљР Р…Р С•Р С–Р С• РЎРѓР В°Р в„–РЎвЂљР В°
    const URLS_AND_POS_FOR_SITE = "SELECT k.id as id, k.name, p.pos, p.pos_dot, u.url FROM `Positions` as p
join Sites as s on (s.id=p.site_id)
join Keywords as k on (k.id=p.keyword_id)
join Urls as u on (u.id=p.url_id)
WHERE p.site_id=#site_id# and to_days(p.date) = to_days(now())";
    // Р С—Р С•Р В»РЎС“РЎвЂЎР С‘РЎвЂљРЎРЉ Р Р†РЎРѓР Вµ Р С”Р В»РЎР‹РЎвЂЎР ВµР Р†Р С‘Р С”Р С‘
    const ALL_KEYWORDS = "SELECT k.id as id,  s.id as s_id, t.id as t_id, k.name, k.yandex, t.name as thematic, s.name as `set` FROM `Keywords` as k
        left join Thematics as t on (t.id=k.thematic_id)
        left join `Sets` as s on (s.id=k.set_id)";
    const URLS_AND_POS_FOR_SET = "SELECT k.id AS k_id, k.name as k_name, st.id as set_id, s.id AS site_id, s.name, p.pos, u.url, p.pos_dot
FROM `Positions` AS p
JOIN Sites AS s ON ( s.id = p.site_id )
JOIN Keywords AS k ON ( k.id = p.keyword_id )
JOIN Urls AS u ON ( u.id = p.url_id )
JOIN `Sets` AS st ON ( st.id = k.set_id )
WHERE set_id = #set_id# AND to_days( p.date ) = to_days( now( ) )
ORDER BY k_id, pos DESC";
    
    //Р С—Р С•Р В»РЎС“РЎвЂЎР С‘РЎвЂљРЎРЉ Р Р†РЎРѓР Вµ РЎРѓР В°Р в„–РЎвЂљРЎвЂ№ РЎРѓ Р С‘РЎвЂ¦ РЎС“РЎР‚Р В»Р В°Р С