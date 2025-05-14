<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Entity\Ultimate;
use App\Entity\Character;
use App\Entity\Lore;

class AppFixtures extends Fixture
{
    private const ROLE_NAMES = [
        'Tank' => [
            'name' => 'Tank',
            'imagePath' => 'images/roles/icon-tank.webp',
        ], 
        'Damage' => [
            'name' => 'Damage',
            'imagePath' => 'images/roles/icon-damage.webp',
        ], 
        'Support' => [
            'name' => 'Support',
            'imagePath' => 'images/roles/icon-support.webp',
        ]];
    private const ULTIMATES_INFOS = [
        'D.Va' => [
            'name' => 'Self Destruct',
            'description' => 'D.Va ejects from her mech and sets its reactor to explode, dealing massive damage to nearby opponents.',
            'ultLine' => '"Nerf This!"',
            'imagePath' => 'images/ultimates/icon-dva.webp'
        ],
        'Doomfist' => [
            'name' => 'Meteor Strike',
            'description' => 'Doomfist leaps into the air then crashes down, dealing massive damage to enemies near the impact point.',
            'ultLine' => '"Meteor Strike!"',
            'imagePath' => 'images/ultimates/icon-doomfist.webp'
        ],
        'Hazard' => [
            'name' => 'Annihilation Matrix',
            'description' => 'Hazard deploys a matrix that deals increasing damage to enemies caught within while healing allies.',
            'ultLine' => '"Tear it down!"',
            'imagePath' => 'images/ultimates/icon-hazard.webp'
        ],
        'Junker Queen' => [
            'name' => 'Rampage',
            'description' => 'Junker Queen charges forward, dealing damage and preventing affected enemies from being healed.',
            'ultLine' => '"Time for the reckoning!"',
            'imagePath' => 'images/ultimates/icon-junker_queen.webp'
        ],
        'Mauga' => [
            'name' => 'Cage Fight',
            'description' => 'Deploy a barrier that traps yourself and enemies. Automatically reloads Mauga\'s Chainguns at the start of the ultimate.',
            'ultLine' => '"Se se\'i koikiiki!"',
            'imagePath' => 'images/ultimates/icon-mauga.webp'
        ],
        'Orisa' => [
            'name' => 'Terra Surge',
            'description' => 'Orisa sweep in enemies and anchor down, gaining the effects of Fortify and charging up a surge of damage. Use Primary Fire to unleash the surge early.',
            'ultLine' => '"Pade ayanmọ rẹ!"',
            'imagePath' => 'images/ultimates/icon-orisa.webp'
        ],
        'Ramattra' => [
            'name' => 'Annihilation',
            'description' => 'Ramattra enters Nemesis Form and creates a damaging energy swarm that lingers as long as it deals damage.',
            'ultLine' => 'Suffer, as I have.',
            'imagePath' => 'images/ultimates/icon-ramattra.webp'
        ],
        'Reinhardt' => [
            'name' => 'Earthshatter',
            'description' => 'Reinhardt slams his hammer into the ground, knocking down and damaging all enemies in front of him.',
            'ultLine' => '"Hammer down!"',
            'imagePath' => 'images/ultimates/icon-reinhardt.webp'
        ],
        'Roadhog' => [
            'name' => 'Whole Hog',
            'description' => 'Roadhog uses his scrap gun to unleash a stream of shrapnel that pushes enemies back and deals massive damage.',
            'ultLine' => '(Mad laughter and coughing)',
            'imagePath' => 'images/ultimates/icon-roadhog.webp'
        ],
        'Sigma' => [
            'name' => 'Gravitic Flux',
            'description' => 'Sigma manipulates gravity to lift enemies into the air and then slams them back down.',
            'ultLine' => '"Het universum zingt voor mij!"',
            'imagePath' => 'images/ultimates/icon-sigma.webp'
        ],
        'Winston' => [
            'name' => 'Primal Rage',
            'description' => 'Winston becomes enraged, gaining significant health and melee knockback power while reducing cooldowns.',
            'ultLine' => '(Roar!)',
            'imagePath' => 'images/ultimates/icon-winston.webp'
        ],
        'Wrecking Ball' => [
            'name' => 'Minefield',
            'description' => 'Wrecking Ball deploys a massive field of proximity mines that explode on contact with enemies.',
            'ultLine' => '"Area denied".',
            'imagePath' => 'images/ultimates/icon-wrecking_ball.webp'
        ],
        'Zarya' => [
            'name' => 'Graviton Surge',
            'description' => 'Zarya launches a gravity bomb that pulls enemies into its center, making them easy targets.',
            'ultLine' => '"Ogon\' po gotovnosti!"',
            'imagePath' => 'images/ultimates/icon-zarya.webp'
        ],
        'Ashe' => [
            'name' => 'B.O.B.',
            'description' => 'Ashe summons her omnic ally B.O.B., who charges forward, knocking enemies into the air and shooting at them with his arm cannons.',
            'ultLine' => '"B.O.B., do something!"',
            'imagePath' => 'images/ultimates/icon-ashe.webp'
        ],
        'Bastion' => [
            'name' => 'Configuration Artillery',
            'description' => 'Bastion locks into artillery mode and targets up to three locations, dealing massive area damage.',
            'ultLine' => 'Ride of the Valkyries Fanfare',
            'imagePath' => 'images/ultimates/icon-bastion.webp'
        ],
        'Cassidy' => [
            'name' => 'Deadeye',
            'description' => 'Cassidy focuses and lines up shots on all visible enemies. After locking on, he fires, dealing massive damage.',
            'ultLine' => '"It\'s high noon."',
            'imagePath' => 'images/ultimates/icon-cassidy.webp'
        ],
        'Echo' => [
            'name' => 'Duplicate',
            'description' => 'Echo duplicates an enemy hero and gains access to all of their abilities for a limited time.',
            'ultLine' => '"Adaptive circuits engaged: [Hero Name]."',
            'imagePath' => 'images/ultimates/icon-echo.webp'
        ],
        'Freja' => [
            'name' => 'Bola Shote',
            'description' => 'Freja fire an explosive bola. Hitting an enemy wraps them up and pulls in other nearby enemies.',
            'ultLine' => 'Nu vanker der',
            'imagePath' => 'images/ultimates/icon-freja.webp'
        ],
        'Genji' => [
            'name' => 'Dragonblade',
            'description' => 'Genji unsheathes his sword for a brief period and can deliver powerful melee slashes.',
            'ultLine' => '"Ryūjin no ken o kurae!"',
            'imagePath' => 'images/ultimates/icon-genji.webp'
        ],
        'Hanzo' => [
            'name' => 'Dragonstrike',
            'description' => 'Hanzo launches a spirit dragon that travels through walls and deals massive damage to enemies in its path.',
            'ultLine' => '"Ryū ga waga teki wo kurau!"',
            'imagePath' => 'images/ultimates/icon-hanzo.webp'
        ],
        'Junkrat' => [
            'name' => 'RIP-Tire',
            'description' => 'Junkrat deploys a motorized tire bomb he can control remotely and detonate to deal heavy damage.',
            'ultLine' => '"Fire in the hole!"',
            'imagePath' => 'images/ultimates/icon-junkrat.webp'
        ],
        'Mei' => [
            'name' => 'Blizzard',
            'description' => 'Mei deploys Snowball, which creates a blizzard that slows and freezes enemies caught in its radius.',
            'ultLine' => '"Dòng zhù! Bùxǔ zǒu!"',
            'imagePath' => 'images/ultimates/icon-mei.webp'
        ],
        'Pharah' => [
            'name' => 'Barrage',
            'description' => 'Pharah hovers in place and unleashes a continuous salvo of mini-rockets to devastate an area.',
            'ultLine' => '"Justice rains from above!"',
            'imagePath' => 'images/ultimates/icon-pharah.webp'
        ],
        'Reaper' => [
            'name' => 'Death Blossom',
            'description' => 'Reaper spins in a circle and fires his shotguns in all directions, dealing massive damage to nearby enemies.',
            'ultLine' => '"Die, die, die!"',
            'imagePath' => 'images/ultimates/icon-reaper.webp'
        ],
        'Sojourn' => [
            'name' => 'Overclock',
            'description' => 'Sojourn\'s railgun charges automatically and fires high-powered shots that pierce enemies.',
            'ultLine' => '"This ends now!"',
            'imagePath' => 'images/ultimates/icon-sojourn.webp'
        ],
        'Soldier: 76' => [
            'name' => 'Tactical Visor',
            'description' => 'Soldier: 76 locks onto targets automatically, making all of his shots aim at enemies in his sights.',
            'ultLine' => '"I\'ve got you in my sights!"',
            'imagePath' => 'images/ultimates/icon-soldier_76.webp'
        ],
        'Sombra' => [
            'name' => 'EMP',
            'description' => 'Sombra releases an EMP that hacks all enemies in range and destroys enemy barriers.',
            'ultLine' => '"Apagando las luces!"',
            'imagePath' => 'images/ultimates/icon-sombra.webp'
        ],
        'Symmetra' => [
            'name' => 'Photon Barrier',
            'description' => 'Symmetra deploys a massive energy barrier that spans the entire map, blocking enemy projectiles.',
            'ultLine' => '"Yahi param vaastavikata hai!"',
            'imagePath' => 'images/ultimates/icon-symmetra.webp'
        ],
        'Torbjörn' => [
            'name' => 'Molten Core',
            'description' => 'Torbjörn sprays molten slag on the ground that damages enemies standing in it.',
            'ultLine' => '"Molten core!"',
            'imagePath' => 'images/ultimates/icon-torbjorn.webp'
        ],
        'Tracer' => [
            'name' => 'Pulse Bomb',
            'description' => 'Tracer throws a sticky explosive that attaches to enemies or surfaces and detonates after a short delay.',
            'ultLine' => '"Bomb\'s ticking!"',
            'imagePath' => 'images/ultimates/icon-tracer.webp'
        ],
        'Venture' => [
            'name' => 'Tectonic Shock',
            'description' => 'Venture slams the ground, creating a powerful shockwave that damages and knocks enemies upward.',
            'ultLine' => '"Excavation initiation!"',
            'imagePath' => 'images/ultimates/icon-venture.webp'
        ],
        'Widowmaker' => [
            'name' => 'Infra-Sight',
            'description' => 'Widowmaker activates her visor to reveal the location of all enemies to her team through walls.',
            'ultLine' => '"No one can hide from my sight..."',
            'imagePath' => 'images/ultimates/icon-widowmaker.webp'
        ],
        'Ana' => [
            'name' => 'Nano Boost',
            'description' => 'Ana boosts an ally, increasing their damage and reducing damage taken.',
            'ultLine' => '"You\'re powered up, get in there!"',
            'imagePath' => 'images/ultimates/icon-ana.webp'
        ],
        'Baptiste' => [
            'name' => 'Amplification Matrix',
            'description' => 'Baptiste creates a matrix that doubles the damage and healing effects of friendly projectiles passing through it.',
            'ultLine' => '"Vide bal sou yo!"',
            'imagePath' => 'images/ultimates/icon-baptiste.webp'
        ],
        'Brigitte' => [
            'name' => 'Rally',
            'description' => 'Brigitte gains extra movement speed and provides armor over time to nearby allies.',
            'ultLine' => '"Alla till mig!"',
            'imagePath' => 'images/ultimates/icon-brigitte.webp'
        ],
        'Illari' => [
            'name' => 'Captive Sun',
            'description' => 'Illari launches a solar charge that slows and marks enemies. Marked enemies explode if they take enough damage.',
            'ultLine' => '"Inti Iluqsimun!"',
            'imagePath' => 'images/ultimates/icon-illari.webp'
        ],
        'Juno' => [
            'name' => 'Mollecular Controller',
            'description' => 'Juno deploys a device that creates a large field which reduces the damage output of enemies caught within it.',
            'ultLine' => '"Locking satellite vector!"',
            'imagePath' => 'images/ultimates/icon-juno.webp'
        ],
        'Kiriko' => [
            'name' => 'Kitsune Rush',
            'description' => 'Kiriko summons a fox spirit that rushes forward, speeding up movement, attack speed, and cooldowns of allies in its path.',
            'ultLine' => '"Kitsune no kagidzume o tokihanate!"',
            'imagePath' => 'images/ultimates/icon-kiriko.webp'
        ],
        'Lifeweaver' => [
            'name' => 'Tree of Life',
            'description' => 'Lifeweaver places a massive biolight tree that periodically heals allies in its area.',
            'ultLine' => '"Chīwit pkp̂xng chīwit!"',
            'imagePath' => 'images/ultimates/icon-lifeweaver.webp'
        ],
        'Lúcio' => [
            'name' => 'Sound Barrier',
            'description' => 'Lúcio provides all nearby allies with a massive temporary shield.',
            'ultLine' => '"Vamos esculachar!"',
            'imagePath' => 'images/ultimates/icon-lùcio.webp'
        ],
        'Mercy' => [
            'name' => 'Valkyrie',
            'description' => 'Mercy gains the ability to fly, boosts her healing and damage beams, and gains increased mobility.',
            'ultLine' => '"Helden sterben nicht!"',
            'imagePath' => 'images/ultimates/icon-mercy.webp'
        ],
        'Moira' => [
            'name' => 'Coalescence',
            'description' => 'Moira fires a long-range beam that simultaneously heals allies and damages enemies.',
            'ultLine' => '"Géill do mo thoil!"',
            'imagePath' => 'images/ultimates/icon-moira.webp'
        ],
        'Zenyatta' => [
            'name' => 'Transcendence',
            'description' => 'Zenyatta enters a state of heightened existence, becoming immune to damage and rapidly healing nearby allies.',
            'ultLine' => '"Pass into the Iris!"',
            'imagePath' => 'images/ultimates/icon-zenyatta.webp'
        ]
    ];
    private const CHARACTER_INFOS = [
        'D.Va' => [
            'name' => 'D.Va',
            'age' => 21,
            'nationality' => 'South Korean',
            'occupation' => 'Pro Gamer, Mech Pilot',
            'releaseDate' => '2016-05-24',
            'description' => 'D.Va is a former professional gamer and a mech pilot for the Mobile Exo-Force of the Korean Army (MEKA).',
            'affiliation' => 'Mobile Exo-Force of the Korean Army (MEKA)',
            'imagePath' => '/images/heroes/icon-D.Va.webp'
        ],
        'Doomfist' => [
            'name' => 'Doomfist',
            'age' => 47,
            'nationality' => 'Nigerian',
            'occupation' => 'Mercenary, Talon Council Member',
            'releaseDate' => '2017-07-27',
            'description' => 'Mercenary and leader of Talon with a personally designed cybernetic gauntlet.',
            'affiliation' => 'Talon',
            'imagePath' => '/images/heroes/icon-doomfist.webp'
        ],
        'Hazard' => [
            'name' => 'Hazard',
            'age' => 24,
            'nationality' => 'Scottish',
            'occupation' => 'Punk Rocker',
            'releaseDate' => '2024-12-10',
            'description' => 'A former Overwatch agent who now works as a mercenary and bounty hunter.',
            'affiliation' => 'Phreaks',
            'imagePath' => '/images/heroes/icon-hazard.webp'
        ],
        'Junker Queen' => [
            'name' => 'Junker Queen',
            'age' => 31,
            'nationality' => 'Australian',
            'occupation' => 'Queen of Junkertown',
            'releaseDate' => '2022-06-28',
            'description' => 'The fierce ruler of Junkertown who wields a battle axe and scattergun.',
            'affiliation' => 'Junkers',
            'imagePath' => '/images/heroes/icon-junker_Queen.webp'
        ],
        'Mauga' => [
            'name' => 'Mauga',
            'age' => 37,
            'nationality' => 'Samoan',
            'occupation' => 'Heavy Assault',
            'releaseDate' => '2023-12-05',
            'description' => 'A massive Samoan fighter equipped with dual machine guns and a passion for battle.',
            'affiliation' => 'Talon',
            'imagePath' => '/images/heroes/icon-mauga.webp'
        ],
        'Orisa' => [
            'name' => 'Orisa',
            'age' => 1,
            'nationality' => 'Numbanian',
            'occupation' => 'Guardian Robot',
            'releaseDate' => '2017-03-21',
            'description' => 'A guardian robot who protects her allies with a barrier and can fortify herself.',
            'affiliation' => 'Numbani',
            'imagePath' => '/images/heroes/icon-orisa.webp'
        ],
        'Ramattra' => [
            'name' => 'Ramattra',
            'age' => 28,
            'nationality' => 'Nepal',
            'occupation' => 'Leader of Null Sector',
            'releaseDate' => '2022-12-06',
            'description' => 'A Null Sector leader who can transform between a tank and a damage-dealing form.',
            'affiliation' => 'Null Sector',
            'imagePath' => '/images/heroes/icon-ramattra.webp'
        ],
        'Reinhardt' => [
            'name' => 'Reinhardt',
            'age' => 63,
            'nationality' => 'German',
            'occupation' => 'Adventurer',
            'releaseDate' => '2016-05-24',
            'description' => 'A knight in shining armor who wields a massive hammer and can create a barrier.',
            'affiliation' => 'Overwatch',
            'imagePath' => '/images/heroes/icon-reinhardt.webp'
        ],
        'Roadhog' => [
            'name' => 'Roadhog',
            'age' => 50,
            'nationality' => 'Australian',
            'occupation' => 'Bodyguard',
            'releaseDate' => '2016-05-24',
            'description' => 'A ruthless killer who wields a shotgun and can heal himself with a gas mask.',
            'affiliation' => 'Junkers (Formerly)',
            'imagePath' => '/images/heroes/icon-roadhog.webp'
        ],
        'Sigma' => [
            'name' => 'Sigma',
            'age' => 64,
            'nationality' => 'Dutch',
            'occupation' => 'Talon living weapon',
            'releaseDate' => '2019-08-13',
            'description' => 'A scientist with the ability to manipulate gravity and create black holes.',
            'affiliation' => 'Talon',
            'imagePath' => '/images/heroes/icon-sigma.webp'
        ],
        'Winston' => [
            'name' => 'Winston',
            'age' => 31,
            'nationality' => '',
            'occupation' => 'Scientist and Adventurer',
            'releaseDate' => '2016-05-24',
            'description' => 'A genetically engineered gorilla who uses a Tesla Cannon and can leap into battle.',
            'affiliation' => 'Overwatch',
            'imagePath' => '/images/heroes/icon-winston.webp'
        ],
        'Wrecking Ball' => [
            'name' => 'Wrecking Ball',
            'age' => 16,
            'nationality' => '',
            'occupation' => 'Mechanic bodyguard',
            'releaseDate' => '2018-07-24',
            'description' => 'A genetically engineered hamster who pilots a mech and can roll into enemies.',
            'affiliation' => 'Junkers',
            'imagePath' => '/images/heroes/icon-wrecking_ball.webp'
        ],
        'Zarya' => [
            'name' => 'Zarya',
            'age' => 30,
            'nationality' => 'Russian',
            'occupation' => 'Soldier',
            'releaseDate' => '2016-05-24',
            'description' => 'A Russian soldier who wields a particle cannon and can create barriers.',
            'affiliation' => 'Overwatch',
            'imagePath' => '/images/heroes/icon-zarya.webp'
        ],
        'Ashe' => [
            'name' => 'Ashe',
            'age' => 41,
            'nationality' => 'American',
            'occupation' => 'Gang leader',
            'releaseDate' => '2018-11-13',
            'description' => 'A leader of the Deadlock Gang who wields a lever-action rifle and can summon a robot sidekick.',
            'affiliation' => 'Deadlock Gang',
            'imagePath' => '/images/heroes/icon-ashe.webp'
        ],
        'Bastion' => [
            'name' => 'Bastion',
            'age' => 32,
            'nationality' => 'American',
            'occupation' => 'Workshop Assistant',
            'releaseDate' => '2016-05-24',
            'description' => 'A robot with the ability to transform into a turret and self-repair.',
            'affiliation' => 'Ironclad Guild',
            'imagePath' => '/images/heroes/icon-bastion.webp'
        ],
        'Cassidy' => [
            'name' => 'Cassidy',
            'age' => 39,
            'nationality' => 'American',
            'occupation' => 'Overwatch agent, Bounty hunter Mercenary',
            'releaseDate' => '2016-05-24',
            'description' => 'A former member of Overwatch who wields a revolver and can roll to dodge.',
            'affiliation' => 'Overwatch',
            'imagePath' => '/images/heroes/icon-cassidy.webp'
        ],
        'Echo' => [
            'name' => 'Echo',
            'age' => 14,
            'nationality' => '',
            'occupation' => 'Multirole adaptive robot',
            'releaseDate' => '2020-04-14',
            'description' => 'An advanced robot with the ability to mimic the abilities of other heroes.',
            'affiliation' => 'Overwatch',
            'imagePath' => '/images/heroes/icon-echo.webp'
        ],
        'Freja' => [
            'name' => 'Freja',
            'age' => 34,
            'nationality' => 'Danish',
            'occupation' => 'Bounty hunter',
            'releaseDate' => '2025-04-22',
            'description' => 'A former Overwatch agent who now works as a mercenary and bounty hunter.',
            'affiliation' => 'Overwatch Search and Rescue (formerly)',
            'imagePath' => '/images/heroes/icon-freja.webp'
        ],
        'Hanzo' => [
            'name' => 'Hanzo',
            'age' => 40,
            'nationality' => 'Japanese',
            'occupation' => 'Assassin Mercenary (temporary)',
            'releaseDate' => '2016-05-24',
            'description' => 'A skilled archer who can climb walls and create a sonic arrow.',
            'affiliation' => 'Shimada Clan (formerly)',
            'imagePath' => '/images/heroes/icon-hanzo.webp'
        ],
        'Junkrat' => [
            'name' => 'Junkrat',
            'age' => 27,
            'nationality' => 'Australian',
            'occupation' => 'Mercenary, Scavenger',
            'releaseDate' => '2016-05-24',
            'description' => 'A demolitionist who uses explosives and can create a tire that rolls and explodes.',
            'affiliation' => 'Junkers (formerly)',
            'imagePath' => '/images/heroes/icon-junkrat.webp'
        ],
        'Mei' => [
            'name' => 'Mei',
            'age' => 33,
            'nationality' => 'Chinese',
            'occupation' => 'Climatologist',
            'releaseDate' => '2016-05-24',
            'description' => 'A climatologist who uses a cryo-freeze gun and can create ice walls.',
            'affiliation' => 'Overwatch',
            'imagePath' => '/images/heroes/icon-mei.webp'
        ],
        'Pharah' => [
            'name' => 'Pharah',
            'age' => 34,
            'nationality' => 'Canadian / Egyptian',
            'occupation' => 'Security Chief',
            'releaseDate' => '2016-05-24',
            'description' => 'A soldier who uses a jetpack and can launch rockets from her suit.',
            'affiliation' => 'Overwatch',
            'imagePath' => '/images/heroes/icon-pharah.webp'
        ],
        'Reaper' => [
            'name' => 'Reaper',
            'age' => 60,
            'nationality' => 'American',
            'occupation' => 'Talon Field agent/council member',
            'releaseDate' => '2016-05-24',
            'description' => 'A former Overwatch agent who can teleport and become invulnerable.',
            'affiliation' => 'Talon',
            'imagePath' => '/images/heroes/icon-reaper.webp'
        ],
        'Sojourn' => [
            'name' => 'Sojourn',
            'age' => 51,
            'nationality' => 'Canadian',
            'occupation' => 'Acting commander (formerly)',
            'releaseDate' => '2022-04-26',
            'description' => 'A former Overwatch agent who uses a railgun and can slide and wall ride.',
            'affiliation' => 'Overwatch',
            'imagePath' => '/images/heroes/icon-sojourn.webp'
        ],
        'Soldier: 76' => [
            'name' => 'Soldier: 76',
            'age' => 58,
            'nationality' => 'American',
            'occupation' => 'Vigilante',
            'releaseDate' => '2016-05-24',
            'description' => 'A vigilante who uses a rifle and can sprint and heal himself.',
            'affiliation' => 'Overwatch (formerly)',
            'imagePath' => '/images/heroes/icon-soldier_76.webp'
        ],
        'Sombra' => [
            'name' => 'Sombra',
            'age' => 32,
            'nationality' => 'Mexican',
            'occupation' => 'Hacker',
            'releaseDate' => '2016-11-15',
            'description' => 'A hacker who can turn invisible and hack enemies.',
            'affiliation' => 'Talon (formerly)',
            'imagePath' => '/images/heroes/icon-sombra.webp'
        ],
        'Symmetra' => [
            'name' => 'Symmetra',
            'age' => 30,
            'nationality' => 'Indian',
            'occupation' => 'Architect',
            'releaseDate' => '2016-05-24',
            'description' => 'An architect who can create turrets and teleporters.',
            'affiliation' => 'Vishkar Corporation',
            'imagePath' => '/images/heroes/icon-symmetra.webp'
        ],
        'Torbjörn' => [
            'name' => 'Torbjörn',
            'age' => 59,
            'nationality' => 'Swedish',
            'occupation' => 'Chief engineer (formerly)',
            'releaseDate' => '2016-05-24',
            'description' => 'An engineer who can build turrets and overload himself.',
            'affiliation' => 'Overwatch',
            'imagePath' => '/images/heroes/icon-torbjorn.webp'
        ],
        'Tracer' => [
            'name' => 'Tracer',
            'age' => 28,
            'nationality' => 'English',
            'occupation' => 'Overwatch agent',
            'releaseDate' => '2016-05-24',
            'description' => 'A time-traveling adventurer who can blink through time and rewind her position.',
            'affiliation' => 'Overwatch (reformed)',
            'imagePath' => '/images/heroes/icon-tracer.webp'
        ],
        'Venture' => [
            'name' => 'Venture',
            'age' => 26,
            'nationality' => 'Canadian / Mexican',
            'occupation' => 'Adventurer',
            'releaseDate' => '2024-04-16',
            'description' => '',
            'affiliation' => 'Wayfinder Society',
            'imagePath' => '/images/heroes/icon-venture.webp'
        ],
        'Widowmaker' => [
            'name' => 'Widowmaker',
            'age' => 35,
            'nationality' => 'French',
            'occupation' => 'Assassin',
            'releaseDate' => '2016-05-24',
            'description' => 'A sniper who can turn invisible and use a grappling hook.',
            'affiliation' => 'Talon',
            'imagePath' => '/images/heroes/icon-widowmaker.webp'
        ],
        'Ana' => [
            'name' => 'Ana',
            'age' => 62,
            'nationality' => 'Egyptian',
            'occupation' => 'Bounty hunter',
            'releaseDate' => '2016-07-19',
            'description' => 'A sniper who can heal allies and put enemies to sleep.',
            'affiliation' => 'Overwatch (formerly)',
            'imagePath' => '/images/heroes/icon-ana.webp'
        ],
        'Baptiste' => [
            'name' => 'Baptiste',
            'age' => 38,
            'nationality' => 'Haitian',
            'occupation' => 'Combat medic',
            'releaseDate' => '2019-03-19',
            'description' => 'A combat medic who can heal allies and create an immortality field.',
            'affiliation' => 'Overwatch',
            'imagePath' => '/images/heroes/icon-baptiste.webp'
        ],
        'Brigitte' => [
            'name' => 'Brigitte',
            'age' => 25,
            'nationality' => 'Swedish',
            'occupation' => 'Adventurer Squire',
            'releaseDate' => '2018-03-20',
            'description' => 'A support hero who can heal allies and use a flail to attack enemies.',
            'affiliation' => 'Overwatch',
            'imagePath' => '/images/heroes/icon-brigitte.webp'
        ],
        'Illari' => [
            'name' => 'Illari',
            'age' => 18,
            'nationality' => 'Peruvian',
            'occupation' => 'Vigilante',
            'releaseDate' => '2023-08-10',
            'description' => 'A healer who can create a turret and heal allies with a beam.',
            'affiliation' => 'Inti Warriors',
            'imagePath' => '/images/heroes/icon-illari.webp'
        ],
        'Juno' => [
            'name' => 'Juno',
            'age' => 19,
            'nationality' => 'Martian',
            'occupation' => 'Navigator',
            'releaseDate' => '2024-08-20',
            'description' => 'A highly mobile hero with a focus on verticality.',
            'affiliation' => 'Project Red Promise',
            'imagePath' => '/images/heroes/icon-juno.webp'
        ],
        'Kiriko' => [
            'name' => 'Kiriko',
            'age' => 21,
            'nationality' => 'Japanese',
            'occupation' => 'Shrine caretaker (Miko)',
            'releaseDate' => '2022-10-04',
            'description' => 'A healer who can teleport and create a protective barrier.',
            'affiliation' => 'Yokai',
            'imagePath' => '/images/heroes/icon-kiriko.webp'
        ],
        'Lifeweaver' => [
            'name' => 'Lifeweaver',
            'age' => 31,
            'nationality' => 'Thai',
            'occupation' => 'Adventurer, Scientist',
            'releaseDate' => '2023-04-11',
            'description' => 'A healer who can create a tree of life and use a grappling hook.',
            'affiliation' => 'The Collective',
            'imagePath' => '/images/heroes/icon-lifeweaver.webp'
        ],
        'Lùcio' => [
            'name' => 'Lùcio',
            'age' => 28,
            'nationality' => 'Brasilian',
            'occupation' => 'DJ, Freedom fighter',
            'releaseDate' => '2016-05-24',
            'description' => 'A DJ who can heal allies and speed them up with his music.',
            'affiliation' => 'The Collective',
            'imagePath' => '/images/heroes/icon-lucio.webp'
        ],
        'Mercy' => [
            'name' => 'Mercy',
            'age' => 39,
            'nationality' => 'Swiss',
            'occupation' => 'Field medic, First responder',
            'releaseDate' => '2016-05-24',
            'description' => 'A healer who can revive allies and boost damages.',
            'affiliation' => 'Overwatch',
            'imagePath' => '/images/heroes/icon-mercy.webp'
        ],
        'Moira' => [
            'name' => 'Moira',
            'age' => 50,
            'nationality' => 'Irish',
            'occupation' => 'Geneticist, Talon council member',
            'releaseDate' => '2017-11-16',
            'description' => 'A scientist who can heal allies and drain the life from enemies.',
            'affiliation' => 'Talon',
            'imagePath' => '/images/heroes/icon-moira.webp'
        ],
        'Zenyatta' => [
            'name' => 'Zenyatta',
            'age' => 33,
            'nationality' => '',
            'occupation' => 'Wanderering guru',
            'releaseDate' => '2016-05-24',
            'description' => 'A monk who can heal allies and shoot orbs of energy at enemies.',
            'affiliation' => 'Shambali Monks',
            'imagePath' => '/images/heroes/icon-zenyatta.webp'
        ]
    ];

    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        // --- USERS ---
        $regularUser = new User();
        $regularUser
            ->setEmail('geodesie@bob.com')
            ->setPassword($this->hasher->hashPassword($regularUser, 'test'));
        $manager->persist($regularUser);

        $adminUser = new User();
        $adminUser
            ->setEmail('admin@overhub.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setPassword($this->hasher->hashPassword($adminUser, 'heroes'));

        $manager->persist($adminUser);

        // --- CATEGORIES ---
        $roles = [];
        foreach (self::ROLE_NAMES as $roleName  => $data) {
            $role = new Role();
            $role
                ->setName($data['name'])
                ->setImagePath($data['imagePath']);
            $manager->persist($role);
            $roles[] = $role;
        }

        // --- ULTIMATES ---
        $ultimates = [];
        foreach (self::ULTIMATES_INFOS as $ultimatesInfos => $data) {
            $ultimate = new Ultimate();
            $ultimate 
                ->setName($data['name'])
                ->setDescription($data['description'])
                ->setUltLine($data['ultLine'])
                ->setImagePath($data['imagePath']);
            $manager->persist($ultimate);
            $ultimates[] = $ultimate;
        }

        // --- CHARACTERS ---
        $characters = [];
        foreach (self::CHARACTER_INFOS as $charactersInfos => $data) {
            $character = new Character();
            $character
                ->setName($data['name'])
                ->setAge($data['age'])
                ->setNationality($data['nationality'])
                ->setOccupation($data['occupation'])
                ->setReleaseDate(new \DateTimeImmutable($data['releaseDate']))
                ->setDescription($data['description'])
                ->setAffiliation($data['affiliation'])
                ->setImagePath($data['imagePath']);
            $manager->persist($character);
            $characters[] = $character;
        }
        $manager->flush();
    }
}
