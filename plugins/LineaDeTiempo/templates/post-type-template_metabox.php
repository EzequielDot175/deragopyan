<table> 
    <tr valign="top">
        <th class="metabox_label_column">
            <label for="eventDate">Fecha del evento</label>
        </th>
        <td>
            <input type="date" id="eventDate" name="eventDate" value="<?php echo @get_post_meta($post->ID, 'eventDate', true); ?>" />
        </td>
    </tr>
</table>
