<?php

/**
 * Returns an associate array using given key as index
 *
 * @param array $items
 * @param string $key
 * @return array
 */
function array_index(array $items, string $key = 'id'): array
{
    $indexedItems = [];
    foreach ($items as $item) {
        $indexedItems[$item->{$key}] = $item;
    }

    return $indexedItems;
}

/**
 * Returns an associate array using given key as index and group values into array
 *
 * @param array $items
 * @param string $key
 * @return array
 */
function array_group_index(array $items, string $key = 'id'): array
{
    $indexedItems = [];
    foreach ($items as $item) {
        if (empty($indexedItems[$item->{$key}])) {
            $indexedItems[$item->{$key}] = [];
        }

        $indexedItems[$item->{$key}][] = $item;
    }

    return $indexedItems;
}
