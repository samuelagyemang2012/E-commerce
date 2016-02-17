<?php

/**
 * Created by PhpStorm.
 * User: samuel
 * Date: 2/4/2016
 * Time: 7:33 PM
 */

include_once("Adb.php");

/**
 * Class Wine
 */
class Wine extends Adb
{

    /**
     * @return bool|mysqli_result
     */
    public function getAllWines()
    {
//        $string = "select distinct
//                   w.wine_id,
//                   w.wine_name,
//                   n.winery_name,
//                   r.region_name,
//                   t.wine_type,
//                   g.variety,
//                   wv.variety_id,
//                   w.year,
//                   i.on_hand,
//                   i.cost
//                   from grape_variety g
//                   inner join wine_variety wv
//                   on wv.variety_id = g.variety_id
//                   inner join wine w
//                   on w.wine_id = wv.wine_id
//                   inner join wine_type t
//                   on w.wine_type = t.wine_type_id
//                   inner join inventory i
//                   on w.wine_id = i.wine_id
//                   inner join winery n
//                   on w.winery_id = n.winery_id
//                   inner join region r
//                   on n.region_id = r.region_id
//                   ORDER BY `w`.`wine_name` ASC";

        $string = "select w.wine_id,
w.wine_name,
t.wine_type,
n.winery_name,
n.winery_id,
w.year,
i.cost
from wine w
inner join wine_type t
on w.wine_type = t.wine_type_id
inner join winery n
ON w.winery_id = n.winery_id
inner join inventory i
on w.wine_id = i.wine_id
order by w.wine_name asc";


        return $this->query($string);
    }


    /**
     * @param $name
     * @return bool|mysqli_result
     */
    public function searchWine($name)
    {

//        $string = "select distinct
//                   w.wine_id,
//                   w.wine_name,
//                   n.winery_name,
//                   r.region_name,
//                   t.wine_type,
//                   g.variety,
//                   wv.variety_id,
//                   w.year,
//                   i.on_hand,
//                   i.cost
//                   from grape_variety g
//                   inner join wine_variety wv
//                   on wv.variety_id = g.variety_id
//                   inner join wine w
//                   on w.wine_id = wv.wine_id
//                   inner join wine_type t
//                   on w.wine_type = t.wine_type_id
//                   inner join inventory i
//                   on w.wine_id = i.wine_id
//                   inner join winery n
//                   on w.winery_id = n.winery_id
//                   inner join region r
//                   on n.region_id = r.region_id
//                   where w.wine_name like ?";
        $string = "select w.wine_id,
w.wine_name,
t.wine_type,
n.winery_name,
n.winery_id,
w.year,
i.cost
from wine w
inner join wine_type t
on w.wine_type = t.wine_type_id
inner join winery n
ON w.winery_id = n.winery_id
inner join inventory i
on w.wine_id = i.wine_id
where w.wine_name like ?";

        $var = "%" . $name . "%";
        $s = $this->prepare($string);
        $s->bind_param('s', $var);
        $s->execute();
        return $s->get_result();
    }


    /**
     * @param $type
     * @return bool|mysqli_result
     */
    public function searchByType($type)
    {
//        $string = "select distinct
//                   w.wine_id,
//                   w.wine_name,
//                   n.winery_name,
//                   r.region_name,
//                   t.wine_type,
//                   g.variety,
//                   wv.variety_id,
//                   w.year,
//                   i.on_hand,
//                   i.cost
//                   from grape_variety g
//                   inner join wine_variety wv
//                   on wv.variety_id = g.variety_id
//                   inner join wine w
//                   on w.wine_id = wv.wine_id
//                   inner join wine_type t
//                   on w.wine_type = t.wine_type_id
//                   inner join inventory i
//                   on w.wine_id = i.wine_id
//                   inner join winery n
//                   on w.winery_id = n.winery_id
//                   inner join region r
//                   on n.region_id = r.region_id
//                   where t.wine_type = ?
//                   ORDER BY `w`.`wine_id` ASC";

        $string = "select w.wine_id,
                   w.wine_name,
                    t.wine_type,
  n.winery_name,
  n.winery_id,
  n.winery_id,
w.year,
i.cost
from wine w
inner join wine_type t
on w.wine_type = t.wine_type_id
inner join winery n
ON w.winery_id = n.winery_id
inner join inventory i
on w.wine_id = i.wine_id
where t.wine_type = ?
order by w.wine_name asc";

        $s = $this->prepare($string);
        $s->bind_param('s', $type);
        $s->execute();
        return $s->get_result();
    }

    /**
     * @return bool|mysqli_result
     */
    public function sortByPrice()
    {
//        $string = "select distinct
//                   w.wine_id,
//                   w.wine_name,
//                   n.winery_name,
//                   r.region_name,
//                   t.wine_type,
//                   g.variety,
//                   wv.variety_id,
//                   w.year,
//                   i.on_hand,
//                   i.cost
//                   from grape_variety g
//                   inner join wine_variety wv
//                   on wv.variety_id = g.variety_id
//                   inner join wine w
//                   on w.wine_id = wv.wine_id
//                   inner join wine_type t
//                   on w.wine_type = t.wine_type_id
//                   inner join inventory i
//                   on w.wine_id = i.wine_id
//                   inner join winery n
//                   on w.winery_id = n.winery_id
//                   inner join region r
//                   on n.region_id = r.region_id
//                   ORDER BY i.cost desc";

        $string = "select w.wine_id,
w.wine_name,
t.wine_type,
n.winery_name,
n.winery_id,
w.year,
i.cost
from wine w
inner join wine_type t
on w.wine_type = t.wine_type_id
inner join winery n
ON w.winery_id = n.winery_id
inner join inventory i
on w.wine_id = i.wine_id
order by i.cost desc";


        return $this->query($string);

    }


    /**
     * @param $id
     * @param $variety
     * @return bool|mysqli_result
     */
    public function getDetails($id)
    {
//        $string = "select distinct
//                   w.wine_id,
//                   w.wine_name,
//                   n.winery_name,
//                   r.region_name,
//                   t.wine_type,
//                   g.variety,
//                   wv.variety_id,
//                   w.year,
//                   i.on_hand,
//                   i.cost
//                   from grape_variety g
//                   inner join wine_variety wv
//                   on wv.variety_id = g.variety_id
//                   inner join wine w
//                   on w.wine_id = wv.wine_id
//                   inner join wine_type t
//                   on w.wine_type = t.wine_type_id
//                   inner join inventory i
//                   on w.wine_id = i.wine_id
//                   inner join winery n
//                   on w.winery_id = n.winery_id
//                   inner join region r
//                   on n.region_id = r.region_id
//                   where w.wine_id = ? and g.variety = ?
//                   order by i.cost DESC ";

        $string = "select w.wine_id,
w.wine_name,
t.wine_type,
n.winery_name,
n.winery_id,
w.year,
i.cost
from wine w
inner join wine_type t
on w.wine_type = t.wine_type_id
inner join winery n
ON w.winery_id = n.winery_id
inner join inventory i
on w.wine_id = i.wine_id
where w.wine_id = ?";

        $s = $this->prepare($string);
        $s->bind_param('i', $id);
        $s->execute();
        return $s->get_result();

    }

    /**
     * @param $name
     * @param $year
     * @return bool|mysqli_result
     */
    public function advancedSearch($name, $year)
    {
        $string = "select w.wine_id,
                   w.wine_name,
                   t.wine_type,
                   n.winery_name,
  n.winery_id,
  w.year,
  i.cost
  from wine w
  inner join wine_type t
    on w.wine_type = t.wine_type_id
  inner join winery n
    ON w.winery_id = n.winery_id
  inner join inventory i
    on w.wine_id = i.wine_id
where w.wine_name = ? and w.year = ?";

        $s = $this->prepare($string);
        $s->bind_param('si', $name, $year);
        $s->execute();
        return $s->get_result();
    }
}

