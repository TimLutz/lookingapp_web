<div class="header">
    <h1 class="page-title">Add LookDate Profile</h1>
</div>

<?php echo $this->Form->create('UserLookdate', array('type' => 'file')); ?>
<?php //echo $this->Form->input('id', array('type' => 'hidden')); ?>

<!-- Button panel start -->
<div class="btn-toolbar">
    <button class="btn btn-primary"><i class="icon-save"></i> Save</button>
</div>
<!-- Button panel end -->

<!-- Form panel start -->
<div class="well">
    <div class="tab-pane active in" id="home">
         <label>User* </label>
        <?php
    $options1 = array('' => '----select----');
    $options1 = $options1 + $options;
   
    echo $this->Form->input('user_id', array('type' => 'select', 'label' => FALSE, 'div' => FALSE, 'class' => 'selectpicker btn-default', 'data-live-search' => 'true', 'id' => 'user_id', 'options' => $options1,'required'=>true));
    ?>

        <label>My Traits </label>
        <?php
        $status_options = array(
            "" => "---Select---",
            "Career Driven" => "Career Driven",
            "Family Oriented" => "Family Oriented",
            "Educated" => "Educated",
            "Romantic" => "Romantic",
            "Passionate" => "Passionate",
            "Religious" => "Religious",
            "Spiritual" => "Spiritual",
            "Agnostic" => "Agnostic",
            "Political" => "Political",
            "Confident" => "Confident",
            "Independent" => "Independent",
            "Ambitious" => "Ambitious",
            "Energetic" => "Energetic",
            "Goal Oriented" => "Goal Oriented",
            "Practical" => "Practical",
            "Outgoing" => "Outgoing",
            "Funny" => "Funny",
            "Sincere" => "Sincere",
            "Creative" => "Creative",
            "Charming" => "Charming",
            "Compassionate" => "Compassionate",
            "Easy Going" => "Easy Going",
            "Reliable" => "Reliable",
            "Witty" => "Witty",
            "Kind" => "Kind",
            "Patient" => "Patient",
            "Affectionate" => "Affectionate",
            "Perfectionist" => "Perfectionist",
            "Analytical" => "Analytical",
            "Toughtful" => "Toughtful",
            "Organized" => "Organized",
            "Home Body" => "Home Body",
            "Serious" => "Serious"
        );
        ?>
        
        <?php echo $this->Form->input('my_traits', array('label' => FALSE, 'div' => FALSE, 'type' => 'select', 'multiple' => true, 'class' => 'input-xlarge', 'id' => 'my_traits', 'options' => $status_options)); ?>
        <label>His Traits </label>
        <?php
        $status_options = array(
            "" => "---Select---",
            "Career Driven" => "Career Driven",
            "Family Oriented" => "Family Oriented",
            "Educated" => "Educated",
            "Romantic" => "Romantic",
            "Passionate" => "Passionate",
            "Religious" => "Religious",
            "Spiritual" => "Spiritual",
            "Agnostic" => "Agnostic",
            "Political" => "Political",
            "Confident" => "Confident",
            "Independent" => "Independent",
            "Ambitious" => "Ambitious",
            "Energetic" => "Energetic",
            "Goal Oriented" => "Goal Oriented",
            "Practical" => "Practical",
            "Outgoing" => "Outgoing",
            "Funny" => "Funny",
            "Sincere" => "Sincere",
            "Creative" => "Creative",
            "Charming" => "Charming",
            "Compassionate" => "Compassionate",
            "Easy Going" => "Easy Going",
            "Reliable" => "Reliable",
            "Witty" => "Witty",
            "Kind" => "Kind",
            "Patient" => "Patient",
            "Affectionate" => "Affectionate",
            "Perfectionist" => "Perfectionist",
            "Analytical" => "Analytical",
            "Toughtful" => "Toughtful",
            "Organized" => "Organized",
            "Home Body" => "Home Body",
            "Serious" => "Serious"
        );
        ?>
        
        <?php echo $this->Form->input('his_traits', array('label' => FALSE, 'div' => FALSE, 'type' => 'select', 'multiple' => true,  'class' => 'input-xlarge', 'id' => 'his_traits', 'options' => $status_options)); ?>
        <label>My Interest </label>
        <?php
        $status_options = array(
            "" => "---Select---",
            "Music" => "Music",
            "Movies" => "Movies",
            "Theater" => "Theater",
            "Sports" => "Sports",
            "Art/Design" => "Art/Design",
            "Fashion" => "Fashion",
            "TV" => "TV",
            "Social Media" => "Social Media",
            "Bars" => "Bars",
            "Clubs" => "Clubs",
            "Dancing" => "Dancing",
            "House Parties" => "House Parties",
            "Concerts" => "Concerts",
            "Gaming" => "Gaming",
            "Reading" => "Reading",
            "Working Out" => "Working Out",
            "Traveling" => "Traveling",
            "Cooking" => "Cooking",
            "Gardening" => "Gardening",
            "Indoor Activities" => "Indoor Activities",
            "Outdoor Activities" => "Outdoor Activities",
            "Self Help" => "Self Help",
            "Volunteering" => "Volunteering",
            "Dinner Parties" => "Dinner Parties",
            "Comfort Food" => "Comfort Food",
            "Vegan" => "Vegan",
            "Dining Out" => "Dining Out",
            "Fine Dining" => "Fine Dining",
            "Children" => "Children",
            "Pets" => "Pets"
        );
        ?>
        
        <?php echo $this->Form->input('my_interest', array('label' => FALSE, 'div' => FALSE, 'type' => 'select', 'multiple' => true,  'class' => 'input-xlarge', 'id' => 'my_interest', 'options' => $status_options)); ?>
        <label>My Physical Appearance </label>
        <?php
        $status_options = array(
            "" => "---Select---",
            "Some Body Hair" => "Some Body Hair",
            "Smooth" => "Smooth",
            "Trimmed" => "Trimmed",
            "Hairy" => "Hairy",
            "Beard" => "Beard",
            "Goatee" => "Goatee",
            "Mustache" => "Mustache",
            "Scruffy" => "Scruffy",
            "Clean Shaven" => "Clean Shaven",
            "Bald" => "Bald",
            "Military/Crew" => "Military/Crew",
            "Buzzed" => "Buzzed",
            "Long" => "Long",
            "Wavy" => "Wavy",
            "Gray" => "Gray",
            "Black" => "Black",
            "Brown" => "Brown",
            "Blond" => "Blond",
            "Ginger" => "Ginger",
            "Piercings" => "Piercings",
            "Tattoos" => "Tattoos",
            "Masculine" => "Masculine",
            "Assimilated" => "Assimilated",
            "Softer/Fem" => "Softer/Fem",
            "Blue Eyes" => "Blue Eyes",
            "Green" => "Green",
            "Gray" => "Gray",
            "Brown" => "Brown",
            "Black" => "Black",
            "Hazel" => "Hazel",
            "Muscular" => "Muscular",
            "Slim" => "Slim",
            "Stocky" => "Stocky",
            "Large" => "Large",
            "Average" => "Average",
            "Toned" => "Toned",
        );
        ?>
        
        <?php echo $this->Form->input('my_physical_appearance', array('label' => FALSE, 'div' => FALSE, 'type' => 'select', 'multiple' => true,  'class' => 'input-xlarge', 'id' => 'my_physical_appearance', 'options' => $status_options)); ?>
        <label>His Physical Appearance </label>
        <?php
        $status_options = array(
            "" => "---Select---",
            "Some Body Hair" => "Some Body Hair",
            "Smooth" => "Smooth",
            "Trimmed" => "Trimmed",
            "Hairy" => "Hairy",
            "Beard" => "Beard",
            "Goatee" => "Goatee",
            "Mustache" => "Mustache",
            "Scruffy" => "Scruffy",
            "Clean Shaven" => "Clean Shaven",
            "Bald" => "Bald",
            "Military/Crew" => "Military/Crew",
            "Buzzed" => "Buzzed",
            "Long" => "Long",
            "Wavy" => "Wavy",
            "Gray" => "Gray",
            "Black" => "Black",
            "Brown" => "Brown",
            "Blond" => "Blond",
            "Ginger" => "Ginger",
            "Piercings" => "Piercings",
            "Tattoos" => "Tattoos",
            "Masculine" => "Masculine",
            "Assimilated" => "Assimilated",
            "Softer/Fem" => "Softer/Fem",
            "Blue Eyes" => "Blue Eyes",
            "Green" => "Green",
            "Gray" => "Gray",
            "Brown" => "Brown",
            "Black" => "Black",
            "Hazel" => "Hazel",
            "Muscular" => "Muscular",
            "Slim" => "Slim",
            "Stocky" => "Stocky",
            "Large" => "Large",
            "Average" => "Average",
            "Toned" => "Toned",
        );
        ?>
        
        <?php echo $this->Form->input('his_physical_appearance', array('label' => FALSE, 'div' => FALSE, 'type' => 'select', 'multiple' => true,  'class' => 'input-xlarge', 'id' => 'his_physical_appearance', 'options' => $status_options)); ?>
        <label>My Sextual Preferences </label>
        <?php
           $status_options = array(
            "" => "---Select---",
            "Top" => "Top",
            "Versatile" => "Versatile",
            "Bottom" => "Bottom",
            "Well Endowed" => "Well Endowed",
            "Average" => "Average",
            "Small" => "Small",
            "Cut" => "Cut",
            "Uncut" => "Uncut",
            "On PrEP" => "On PrEP",
            "Safe" => "Safe",
            "Raw" => "Raw",
            "Let's Discuss" => "Let's Discuss",
            "One on One" => "One on One",
            "Couples" => "Couples",
            "Anonymous" => "Anonymous",
            "Groups" => "Groups",
            "Saint" => "Saint",
            "Sinner" => "Sinner",
            "Oral⬆︎" => "Oral⬆︎",
            "Oral⬇︎" => "Oral⬇︎",
            "Voyeur" => "Voyeur",
            "Exhibitionist" => "Exhibitionist",
            "Verbal" => "Verbal",
            "Role Play" => "Role Play",
            "Toys" => "Toys",
            "Fist⬆︎" => "Fist⬆︎",
            "Fist⬇︎" => "Fist⬇︎",
            "Bondage" => "Bondage",
            "Rough" => "Rough",
            "Raunchy" => "Raunchy",
            "Kinky" => "Kinky",
            "Spanking⬆︎" => "Spanking⬆︎",
            "Spanking⬇︎" => "Spanking⬇︎",
            "Underwear" => "Underwear",
            "Gear" => "Gear",
            "WS⬆︎" => "WS⬆︎",
            "WS⬇︎" => "WS⬇︎",
            "Kissing" => "Kissing",
            "Rimming⬆︎" => "Rimming⬆︎",
            "Rimming⬇︎" => "Rimming⬇︎",
            "Master" => "Master",
            "Slave" => "Slave",
        );
        ?>
       
        <?php echo $this->Form->input('my_sextual_preferences', array('label' => FALSE, 'div' => FALSE, 'type' => 'select', 'multiple' => true,  'class' => 'input-xlarge', 'id' => 'my_sextual_preferences', 'options' => $status_options)); ?>
        <label>His Sextual Preferences </label>
        <?php
           $status_options = array(
            "" => "---Select---",
            "Top" => "Top",
            "Versatile" => "Versatile",
            "Bottom" => "Bottom",
            "Well Endowed" => "Well Endowed",
            "Average" => "Average",
            "Small" => "Small",
            "Cut" => "Cut",
            "Uncut" => "Uncut",
            "On PrEP" => "On PrEP",
            "Safe" => "Safe",
            "Raw" => "Raw",
            "Let's Discuss" => "Let's Discuss",
            "One on One" => "One on One",
            "Couples" => "Couples",
            "Anonymous" => "Anonymous",
            "Groups" => "Groups",
            "Saint" => "Saint",
            "Sinner" => "Sinner",
            "Oral⬆︎" => "Oral⬆︎",
            "Oral⬇︎" => "Oral⬇︎",
            "Voyeur" => "Voyeur",
            "Exhibitionist" => "Exhibitionist",
            "Verbal" => "Verbal",
            "Role Play" => "Role Play",
            "Toys" => "Toys",
            "Fist⬆︎" => "Fist⬆︎",
            "Fist⬇︎" => "Fist⬇︎",
            "Bondage" => "Bondage",
            "Rough" => "Rough",
            "Raunchy" => "Raunchy",
            "Kinky" => "Kinky",
            "Spanking⬆︎" => "Spanking⬆︎",
            "Spanking⬇︎" => "Spanking⬇︎",
            "Underwear" => "Underwear",
            "Gear" => "Gear",
            "WS⬆︎" => "WS⬆︎",
            "WS⬇︎" => "WS⬇︎",
            "Kissing" => "Kissing",
            "Rimming⬆︎" => "Rimming⬆︎",
            "Rimming⬇︎" => "Rimming⬇︎",
            "Master" => "Master",
            "Slave" => "Slave",
        );
        ?>
       
        <?php echo $this->Form->input('his_sextual_preferences', array('label' => FALSE, 'div' => FALSE, 'type' => 'select', 'multiple' => true,  'class' => 'input-xlarge', 'id' => 'his_sextual_preferences', 'options' => $status_options)); ?>
        <label>My Social Habits </label>
        <?php
        $status_options = array(
            "" => "---Select---",
            "Smoker " => "Smoker ",
            "Non Smoker" => "Non Smoker",
            "Social Smoker" => "Social Smoker",
            "Alcohol" => "Alcohol",
            "Weed" => "Weed",
            "PNP" => "PNP",
            "Drug Tolerant" => "Drug Tolerant",
            "Sober" => "Sober",
        );
        ?>
        
        <?php echo $this->Form->input('my_social_habits', array('label' => FALSE, 'div' => FALSE, 'type' => 'select', 'multiple' => true,  'class' => 'input-xlarge', 'id' => 'my_social_habits', 'options' => $status_options)); ?>
        <label>His Social Habits </label>
        <?php
        $status_options = array(
            "" => "---Select---",
            "Smoker " => "Smoker ",
            "Non Smoker" => "Non Smoker",
            "Social Smoker" => "Social Smoker",
            "Alcohol" => "Alcohol",
            "Weed" => "Weed",
            "PNP" => "PNP",
            "Drug Tolerant" => "Drug Tolerant",
            "Sober" => "Sober",
        );
        ?>
       
        <?php echo $this->Form->input('his_social_habits', array('label' => FALSE, 'div' => FALSE, 'type' => 'select', 'multiple' => true,  'class' => 'input-xlarge', 'id' => 'his_social_habits', 'options' => $status_options)); ?>
    </div>

</div>
<!-- Form panel end -->
<?php echo $this->Form->end(); ?>

