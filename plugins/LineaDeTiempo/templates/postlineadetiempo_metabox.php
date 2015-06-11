<table> 
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="meta_a">Date event</label>
        </th>
        <td>
            <input type="date" id="eventDate" name="eventDate" value="<?php echo @get_post_meta($post->ID, 'eventDate', true); ?>" />
        </td>
    </tr>
</table>
