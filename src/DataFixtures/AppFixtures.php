<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use App\Entity\Ability;
use App\Entity\Character;
use App\Entity\Lore;

class AppFixtures extends Fixture
{
    private const ROLE_NAMES = ['Tank', 'Damage', 'Support'];

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
        $characters = [];

        foreach (self::ROLE_NAMES as $roleName) {
            $role = new Role();
            $role->setName($roleName);
            $manager->persist($role);
            $roles[] = $role;
        }

        // --- CHARACTERS ---
        // TANK
        // D.Va
        $character1 = new Character();
        $character1
            ->setName('D.Va')
            ->setAge(21)
            ->setNationality('South Korean')
            ->setOccupation('Pro Gamer, Mech Pilot')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('D.Va is a former professional gamer and a mech pilot for the Mobile Exo-Force of the Korean Army (MEKA).')
            ->setAffiliation('Mobile Exo-Force of the Korean Army (MEKA)');
        $manager->persist($character1);
        $characters[] = $character1;

        // Doomfist
        $character2 = new Character();
        $character2
            ->setName('Doomfist')
            ->setAge(47)
            ->setNationality('Nigerian')
            ->setOccupation('Mercenary, Talon Council Member')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('Mercenary and leader of Talon with a personally designed cybernetic gauntlet.')
            ->setAffiliation('Talon');
        $manager->persist($character2);
        $characters[] = $character2;

        // Hazard
        $character3 = new Character();
        $character3
            ->setName('Hazard')
            ->setAge(24)
            ->setNationality('Scottish')
            ->setOccupation('Punk Rocker')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A former Overwatch agent who now works as a mercenary and bounty hunter.')
            ->setAffiliation('Phreaks');
        $manager->persist($character3);
        $characters[] = $character3;

        // Junker Queen
        $character4 = new Character();
        $character4
            ->setName('Junker Queen')
            ->setAge(31)
            ->setNationality('Australian')
            ->setOccupation('Queen of Junkertown')
            ->setReleaseDate(new \DateTimeImmutable('2022-06-28'))
            ->setDescription('The fierce ruler of Junkertown who wields a battle axe and scattergun.')
            ->setAffiliation('Junkers');
        $manager->persist($character4);
        $characters[] = $character4;

        // Mauga
        $character5 = new Character();
        $character5
            ->setName('Mauga')
            ->setAge(37)
            ->setNationality('Samoan')
            ->setOccupation('Heavy Assault')
            ->setReleaseDate(new \DateTimeImmutable('2023-12-05'))
            ->setDescription('A massive Samoan fighter equipped with dual machine guns and a passion for battle.')
            ->setAffiliation('Talon');
        $manager->persist($character5);
        $characters[] = $character5;

        // Orisa
        $character6 = new Character();
        $character6
            ->setName('Orisa')
            ->setAge(1)
            ->setNationality('Numbanian')
            ->setOccupation('Guardian Robot')
            ->setReleaseDate(new \DateTimeImmutable('2017-03-21'))
            ->setDescription('A guardian robot who protects her allies with a barrier and can fortify herself.')
            ->setAffiliation('Numbani');
        $manager->persist($character6);
        $characters[] = $character6;

        // Ramattra
        $character7 = new Character();
        $character7
            ->setName('Ramattra')
            ->setAge(28)
            ->setNationality('Nepal')
            ->setOccupation('Leader of Null Sector')
            ->setReleaseDate(new \DateTimeImmutable('2022-12-06'))
            ->setDescription('A Null Sector leader who can transform between a tank and a damage-dealing form.')
            ->setAffiliation('Null Sector');
        $manager->persist($character7);
        $characters[] = $character7;

        // Reinhardt
        $character8 = new Character();
        $character8
            ->setName('Reinhardt')
            ->setAge(63)
            ->setNationality('German')
            ->setOccupation('Adventurer')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A knight in shining armor who wields a massive hammer and can create a barrier.')
            ->setAffiliation('Overwatch');
        $manager->persist($character8);
        $characters[] = $character8;

        // Roadhog
        $character9 = new Character();
        $character9
            ->setName('Roadhog')
            ->setAge(50)
            ->setNationality('Australian')
            ->setOccupation('Bodyguard')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A ruthless killer who wields a shotgun and can heal himself with a gas mask.')
            ->setAffiliation('Junkers (Formerly)');
        $manager->persist($character9);
        $characters[] = $character9;

        // Sigma
        $character10 = new Character();
        $character10
            ->setName('Sigma')
            ->setAge(64)
            ->setNationality('Dutch')
            ->setOccupation('Talon living weapon')
            ->setReleaseDate(new \DateTimeImmutable('2019-08-13'))
            ->setDescription('A scientist with the ability to manipulate gravity and create black holes.')
            ->setAffiliation('Talon');
        $manager->persist($character10);
        $characters[] = $character10;

        // Winston
        $character11 = new Character();
        $character11
            ->setName('Winston')
            ->setAge(31)
            ->setNationality('')
            ->setOccupation('Scientist and Adventurer')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A genetically engineered gorilla who uses a Tesla Cannon and can leap into battle.')
            ->setAffiliation('Overwatch');
        $manager->persist($character11);
        $characters[] = $character11;

        // Wrecking Ball
        $character12 = new Character();
        $character12
            ->setName('Wrecking Ball')
            ->setAge(16)
            ->setNationality('')
            ->setOccupation('Mechanic bodyguard')
            ->setReleaseDate(new \DateTimeImmutable('2018-07-24'))
            ->setDescription('A genetically engineered hamster who pilots a mech and can roll into enemies.')
            ->setAffiliation('Junkers');
        $manager->persist($character12);
        $characters[] = $character12;

        // Zarya
        $character13 = new Character();
        $character13
            ->setName('Zarya')
            ->setAge(30)
            ->setNationality('Russian')
            ->setOccupation('Soldier')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A Russian soldier who wields a particle cannon and can create barriers.')
            ->setAffiliation('Overwatch');
        $manager->persist($character13);
        $characters[] = $character13;

        // DAMAGE
        // Ashe
        $character14 = new Character();
        $character14
            ->setName('Ashe')
            ->setAge(41)
            ->setNationality('American')
            ->setOccupation('Gang leader')
            ->setReleaseDate(new \DateTimeImmutable('2018-11-13'))
            ->setDescription('A leader of the Deadlock Gang who wields a lever-action rifle and can summon a robot sidekick.')
            ->setAffiliation('Deadlock Gang');
        $manager->persist($character14);
        $characters[] = $character14;

        // Bastion
        $character15 = new Character();
        $character15
            ->setName('Bastion')
            ->setAge(32)
            ->setNationality('American')
            ->setOccupation('Workshop Assistant')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A robot with the ability to transform into a turret and self-repair.')
            ->setAffiliation('Ironclad Guild');
        $manager->persist($character15);
        $characters[] = $character15;

        // Cassidy
        $character16 = new Character();
        $character16
            ->setName('Cassidy')
            ->setAge(39)
            ->setNationality('American')
            ->setOccupation('Overwatch agent, Bounty hunter Mercenary')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A former member of Overwatch who wields a revolver and can roll to dodge.')
            ->setAffiliation('Overwatch');
        $manager->persist($character16);
        $characters[] = $character16;

        // Echo
        $character17 = new Character();
        $character17
            ->setName('Echo')
            ->setAge(14)
            ->setNationality('')
            ->setOccupation('Multirole adaptive robot')
            ->setReleaseDate(new \DateTimeImmutable('2020-04-14'))
            ->setDescription('An advanced robot with the ability to mimic the abilities of other heroes.')
            ->setAffiliation('Overwatch');
        $manager->persist($character17);
        $characters[] = $character17;

        // Freja
        $character18 = new Character();
        $character18
            ->setName('Freja')
            ->setAge(34)
            ->setNationality('Danish')
            ->setOccupation('Bounty hunter')
            ->setReleaseDate(new \DateTimeImmutable('2025-04-22'))
            ->setDescription('A former Overwatch agent who now works as a mercenary and bounty hunter.')
            ->setAffiliation('Overwatch Search and Rescue (formerly)');
        $manager->persist($character18);
        $characters[] = $character18;

        // Hanzo
        $character19 = new Character();
        $character19
            ->setName('Hanzo')
            ->setAge(40)
            ->setNationality('Japanese')
            ->setOccupation('Assassin Mercenary (temporary)')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A skilled archer who can climb walls and create a sonic arrow.')
            ->setAffiliation('Shimada Clan (formerly)');
        $manager->persist($character19);
        $characters[] = $character19;

        // Junkrat
        $character20 = new Character();
        $character20
            ->setName('Junkrat')
            ->setAge(27)
            ->setNationality('Australian')
            ->setOccupation('Mercenary, Scavenger')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A demolitionist who uses explosives and can create a tire that rolls and explodes.')
            ->setAffiliation('Junkers (formerly)');
        $manager->persist($character20);
        $characters[] = $character20;

        // Mei
        $character21 = new Character();
        $character21
            ->setName('Mei')
            ->setAge(33)
            ->setNationality('Chinese')
            ->setOccupation('Climatologist')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A climatologist who uses a cryo-freeze gun and can create ice walls.')
            ->setAffiliation('Overwatch');
        $manager->persist($character21);
        $characters[] = $character21;

        // Pharah
        $character22 = new Character();
        $character22
            ->setName('Pharah')
            ->setAge(34)
            ->setNationality('Canadian / Egyptian')
            ->setOccupation('Security Chief')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A soldier who uses a jetpack and can launch rockets from her suit.')
            ->setAffiliation('Overwatch');
        $manager->persist($character22);
        $characters[] = $character22;

        // Reaper
        $character23 = new Character();
        $character23
            ->setName('Reaper')
            ->setAge(60)
            ->setNationality('American')
            ->setOccupation('Talon Field agent/council member')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A former Overwatch agent who can teleport and become invulnerable.')
            ->setAffiliation('Talon');
        $manager->persist($character23);
        $characters[] = $character23;

        // Sojourn
        $character24 = new Character();
        $character24
            ->setName('Sojourn')
            ->setAge(51)
            ->setNationality('Canadian')
            ->setOccupation('Acting commander (formerly)')
            ->setReleaseDate(new \DateTimeImmutable('2022-04-26'))
            ->setDescription('A former Overwatch agent who uses a railgun and can slide and wall ride.')
            ->setAffiliation('Overwatch');
        $manager->persist($character24);
        $characters[] = $character24;

        // Soldier: 76
        $character25 = new Character();
        $character25
            ->setName('Soldier: 76')
            ->setAge(58)
            ->setNationality('American')
            ->setOccupation('Vigilante')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A vigilante who uses a rifle and can sprint and heal himself.')
            ->setAffiliation('Overwatch (formerly)');
        $manager->persist($character25);
        $characters[] = $character25;

        // Sombra
        $character26 = new Character();
        $character26
            ->setName('Sombra')
            ->setAge(32)
            ->setNationality('Mexican')
            ->setOccupation('Hacker')
            ->setReleaseDate(new \DateTimeImmutable('2016-11-15'))
            ->setDescription('A hacker who can turn invisible and hack enemies.')
            ->setAffiliation('Talon (formerly)');
        $manager->persist($character26);
        $characters[] = $character26;

        // Symmetra
        $character27 = new Character();
        $character27
            ->setName('Symmetra')
            ->setAge(30)
            ->setNationality('Indian')
            ->setOccupation('Architect')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('An architect who can create turrets and teleporters.')
            ->setAffiliation('Vishkar Corporation');
        $manager->persist($character27);
        $characters[] = $character27;

        // Torbjörn
        $character28 = new Character();
        $character28
            ->setName('Torbjörn')
            ->setAge(59)
            ->setNationality('Swedish')
            ->setOccupation('Chief engineer (formerly)')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('An engineer who can build turrets and overload himself.')
            ->setAffiliation('Overwatch');
        $manager->persist($character28);
        $characters[] = $character28;

        //Tracer
        $character29 = new Character();
        $character29
            ->setName('Tracer')
            ->setAge(28)
            ->setNationality('English')
            ->setOccupation('Overwatch agent')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A time-traveling adventurer who can blink through time and rewind her position.')
            ->setAffiliation('Overwatch (reformed)');

        $manager->persist($character29);
        $characters[] = $character29;

        // Fixture pour Venture
        $character30 = new Character();
        $character30
            ->setName('Venture')
            ->setAge(26)
            ->setNationality('Canadian / Mexican')
            ->setOccupation('Adventurer')
            ->setReleaseDate(new \DateTimeImmutable('2024-04-16'))
            ->setDescription('')
            ->setAffiliation('Wayfinder Society');

        $manager->persist($character30);
        $characters[] = $character30;

        // Fixture pour Widowmaker
        $character31 = new Character();
        $character31
            ->setName('Widowmaker')
            ->setAge(35)
            ->setNationality('French')
            ->setOccupation('Assassin')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A sniper who can turn invisible and use a grappling hook.')
            ->setAffiliation('Talon');
        $manager->persist($character31);
        $characters[] = $character31;

        // SUPPORT
        // Ana
        $character32 = new Character();
        $character32
            ->setName('Ana')
            ->setAge(62)
            ->setNationality('Egyptian')
            ->setOccupation('Bounty hunter')
            ->setReleaseDate(new \DateTimeImmutable('2016-07-19'))
            ->setDescription('A sniper who can heal allies and put enemies to sleep.')
            ->setAffiliation('Overwatch (formerly)');
        $manager->persist($character32);
        $characters[] = $character32;

        // Baptiste
        $character33 = new Character();
        $character33
            ->setName('Baptiste')
            ->setAge(38)
            ->setNationality('Haitian')
            ->setOccupation('Combat medic')
            ->setReleaseDate(new \DateTimeImmutable('2019-03-19'))
            ->setDescription('A combat medic who can heal allies and create an immortality field.')
            ->setAffiliation('Overwatch');
        $manager->persist($character33);
        $characters[] = $character33;

        // Brigitte
        $character34 = new Character();
        $character34
            ->setName('Brigitte')
            ->setAge(25)
            ->setNationality('Swedish')
            ->setOccupation('Adventurer Squire')
            ->setReleaseDate(new \DateTimeImmutable('2018-03-20'))
            ->setDescription('A support hero who can heal allies and use a flail to attack enemies.')
            ->setAffiliation('Overwatch');
        $manager->persist($character34);
        $characters[] = $character34;

        // Illari
        $character35 = new Character();
        $character35
            ->setName('Illari')
            ->setAge(18)
            ->setNationality('Peruvian')
            ->setOccupation('Vigilante')
            ->setReleaseDate(new \DateTimeImmutable('2023-08-10'))
            ->setDescription('A healer who can create a turret and heal allies with a beam.')
            ->setAffiliation('Inti Warriors');
        $manager->persist($character35);
        $characters[] = $character35;

        // Juno
        $character36 = new Character();
        $character36
            ->setName('Juno')
            ->setAge(19)
            ->setNationality('Martian')
            ->setOccupation('Navigator')
            ->setReleaseDate(new \DateTimeImmutable('2024-08-20'))
            ->setDescription('A highly mobile hero with a focus on verticality.')
            ->setAffiliation('Project Red Promise');
        $manager->persist($character36);
        $characters[] = $character36;

        // Kiriko
        $character37 = new Character();
        $character37
            ->setName('Kiriko')
            ->setAge(21)
            ->setNationality('Japanese')
            ->setOccupation('Shrine caretaker (Miko)')
            ->setReleaseDate(new \DateTimeImmutable('2022-10-04'))
            ->setDescription('A healer who can teleport and create a protective barrier.')
            ->setAffiliation('Yokai');
        $manager->persist($character37);
        $characters[] = $character37;

        // Lifeweaver
        $character38 = new Character();
        $character38
            ->setName('Lifeweaver')
            ->setAge(31)
            ->setNationality('Thai')
            ->setOccupation('Adventurer, Scientist')
            ->setReleaseDate(new \DateTimeImmutable('2023-04-11'))
            ->setDescription('A healer who can create a tree of life and use a grappling hook.')
            ->setAffiliation('The Collective');
        $manager->persist($character38);
        $characters[] = $character38;

        // Lùcio
        $character39 = new Character();
        $character39
            ->setName('Lùcio')
            ->setAge(28)
            ->setNationality('Brasilian')
            ->setOccupation('DJ, Freedom fighter')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A DJ who can heal allies and speed them up with his music.')
            ->setAffiliation('The Collective');
        $manager->persist($character39);
        $characters[] = $character39;

        // Mercy
        $character40 = new Character();
        $character40
            ->setName('Mercy')
            ->setAge(39)
            ->setNationality('Swiss')
            ->setOccupation('Field medic, First responder')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A healer who can revive allies and boost damages.')
            ->setAffiliation('Overwatch');
        $manager->persist($character40);
        $characters[] = $character40;

        // Moira
        $character41 = new Character();
        $character41
            ->setName('Moira')
            ->setAge(50)
            ->setNationality('Irish')
            ->setOccupation('Geneticist, Talon council member')
            ->setReleaseDate(new \DateTimeImmutable('2017-11-16'))
            ->setDescription('A scientist who can heal allies and drain the life from enemies.')
            ->setAffiliation('Talon');
        $manager->persist($character41);
        $characters[] = $character41;

        // Zenyatta
        $character42 = new Character();
        $character42
            ->setName('Zenyatta')
            ->setAge(33)
            ->setNationality('')
            ->setOccupation('Wanderering guru')
            ->setReleaseDate(new \DateTimeImmutable('2016-05-24'))
            ->setDescription('A monk who can heal allies and shoot orbs of energy at enemies.')
            ->setAffiliation('Shambali Monks');
        $manager->persist($character42);
        $characters[] = $character42;

        $manager->flush();
        }
    }
