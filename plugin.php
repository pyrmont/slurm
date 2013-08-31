<?php
    
class InqkSlurm extends KokenPlugin {
    
    function __construct()
    {
        $this->register_hook('content.create', 'create_slug');
        $this->register_hook('content.update', 'update_slug');
    }
    
    function create_slug($obj)
    {
        // Update the object with the magical slug.
        $this->update_slug($obj);
    }
    
    function update_slug($obj)
    {
        // Generate the slug.
        $slug_name = $this->generate_slug($obj['id'], substr($obj['uploaded_on']['timestamp'], -5));
        
        /* Following doesn't work because Slug model isn't implemented properly.
        // Get slug from the database.
        $slug = new Slug;
        $slug->get_by_id('content.' . $slug_name);
        
        // Add it to the database if it doesn't exist.
        if (!$slug->exists()) {
            $slug->id = 'content.' . $slug_name;
            $slug->save();
        }
        */
        
        // Construct content object.
        $content = new Content($obj['id']);
        
        // Set the new slug.
        $content->slug = $slug_name;
        $content->old_slug = $slug_name;
        $content->save();
    }
    
    function generate_slug($content_id, $content_timestamp)
    {
        // Append the ID to the timestamp partial.
        $numbers = $content_timestamp . $content_id;
        
        // Create an array.
        $numbers_array = str_split($numbers);
        
        // Calculate checksum.
        $checksum = 0;
        foreach ($numbers_array as $number) { $checksum = $checksum + $number; }
        $checksum = $checksum % 10;
        
        $slug = $numbers . $checksum;
        
        return $slug;
    }    
}
    
?>