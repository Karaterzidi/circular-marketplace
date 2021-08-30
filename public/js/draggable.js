const draggables = document.querySelectorAll('.draggable-element');

draggables.forEach(function(draggable) {
  draggable.addEventListener('dragstart', handleDragging, false);
  draggable.addEventListener('dragend', handleDragEnd, false);
});


function handleDragging(e) {
  e.currentTarget.classList.add('dragging');
}

function handleDragEnd(e) {
  e.currentTarget.classList.remove('dragging');
  setPosition();
}



const dragContainer = document.querySelector('.drag-container');
dragContainer.addEventListener('dragover', function(e) {
  e.preventDefault();

  const afterElement = getDragAfterElement(e.currentTarget, e.clientY);

  const dragging = document.querySelector('.dragging');
  if (!afterElement) {
    e.currentTarget.appendChild(dragging);
  }
  else {
    e.currentTarget.insertBefore(dragging, afterElement)
  }

});



function getDragAfterElement(container, y) {
  const draggables = [...container.querySelectorAll('.draggable-element:not(.dragging)')];

  return draggables.reduce(function(closest, child) {
    const box = child.getBoundingClientRect();
    const offset = y - box.top - box.height / 2;
    if (offset < 0 && offset > closest.offset) {
      return { offset: offset, element: child}
    }
    else {
      return closest;
    }

  }, {offset: Number.NEGATIVE_INFINITY}).element
}



function setPosition() {
  const positionedDrags = [...document.querySelectorAll('.draggable-element')];
  const drags = positionedDrags.map(drag => drag.dataset.position)

  const positionedInputs = [...document.querySelectorAll('.position-input')];

  for(const [index, drag] of drags.entries()){
     positionedInputs[index].value = drag;
  }
}
