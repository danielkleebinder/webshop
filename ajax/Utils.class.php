<?php

/**
 * Contains the most important utility methods.
 *
 * @author Daniel Kleebinder
 */
class Utils {

    public static function is_valid_string($str) {
        return !(!isset($str) || trim($str) === '');
    }

    public static function cart_total_price() {
        $result = 0;
        $wdb = new WebshopDatabase();
        $products = $wdb->all_products();
        foreach ($products as $value) {
            if (isset($_SESSION['cart'][$value->get_id()])) {
                $result +=($_SESSION ['cart'][$value->get_id()] * $value->get_price());
            }
        }
        $wdb->disconnect();
        return $result;
    }

    public static function cart_total_amount() {
        $result = 0;
        foreach ($_SESSION['cart'] as $value) {
            $result += $value;
        }
        return $result;
    }

    public static function is_product_in_cart($id) {
        return isset($_SESSION['cart'][$id]);
    }

    private static function create_atom_feed($feed, $entry_count) {
        $result = '<div class="jumbotron">';
        $result .= '<h1>' . $feed->title . '</h1>';
        $result .= '<p>Lastly Modified: ' . $feed->updated . '</p>';
        $result .= '</div>';

        $counter = 0;
        foreach ($feed->entry as $entry) {
            if (isset($entry_count) && $entry_count > 0) {
                $counter++;
                if ($counter > $entry_count) {
                    break;
                }
            }
            $result .= '<div>';
            $result .= '<div class="panel panel-primary">';
            $result .= '<div class="panel-heading">' . $entry->title . '</div>';
            $result .= '<div class="panel-body">' . $entry->summary . '</div>';
            $result .= '<div class="panel-footer"><a target="_blank" href="' . $entry->getAttribute('href') . '">Read More ...</a></div>';
            $result .= '</div>';
            $result .= '</div>';
        }
        return $result;
    }

    private static function create_rss_feed($feed, $entry_count) {
        $result = '<div class="jumbotron">';
        $result .= '<h1>' . $feed->channel->title . '</h1>';
        $result .= '<p>' . $feed->channel->description . '</p>';
        $result .= '</div>';

        $items = $feed->item;
        if (isset($feed->channel->item)) {
            $items = $feed->channel->item;
        }

        $counter = 0;
        foreach ($items as $entry) {
            if (isset($entry_count) && $entry_count > 0) {
                $counter++;
                if ($counter > $entry_count) {
                    break;
                }
            }
            $result .= '<div>';
            $result .= '<div class="panel panel-primary">';
            $result .= '<div class="panel-heading">' . $entry->title . '</div>';
            $result .= '<div class="panel-body">' . $entry->description . '</div>';
            $result .= '<div class="panel-footer"><a target="_blank" href="' . $entry->link . '">Read More ...</a></div>';
            $result .= '</div>';
            $result .= '</div>';
        }
        return $result;
    }

    public static function create_feed($url, $entry_count) {
        if (!Utils::is_valid_string($url)) {
            return '<div id="error-alert" class="alert alert-danger col-md-12" style="display: block"><strong>Error: </strong> The given URL is empty!</div>';
        }

        $content = @file_get_contents($url);
        if (!$content) {
            return '<div id="error-alert" class="alert alert-danger col-md-12" style="display: block"><strong>Error: </strong> Not able to open the given link! Try again or check your link for any spelling mistakes.</div>';
        }

        $feed = new SimpleXMLElement($content);
        if ($feed->getName() == 'feed') {
            return Utils::create_atom_feed($feed, $entry_count);
        }
        return Utils::create_rss_feed($feed, $entry_count);
    }

}
