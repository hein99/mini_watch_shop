<?php displayAdminPageHeader('Orders List', 'orders') ?>
<main class='w-80'>
    <h1 class="pg-title">Orders</h1>
    <form method="get" class="order-filter">
        <input type="hidden" name="start" value="<?php echo $data['start'] ?>">
        <div>
            <label for="status">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                    <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2z"/>
                </svg>
            </label>
            <select name="status" id="status">
                <option value="all">All</option>
                <option value="ordered">Ordered</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
            <input type="submit" value="Filter">
        </div>
    </form>
    
    <div class="order-table-container">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Ordered At</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($data['orders'] as $order) : ?>
                    <tr>
                        <td>
                            <?php echo $order->getValueEncoded('customer_name') ?>
                            <a href="<?php echo APP_URL ?>admin/orders/edit/<?php echo $order->getValue('id') ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                                    <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                                </svg>
                            </a>
                        </td>
                        <td><?php echo $order->getValueEncoded('customer_phone') ?></td>
                        <td><?php echo $order->getValueEncoded('customer_address') ?></td>
                        <td><div class="status <?php echo $order->getValueEncoded('status') ?>"><?php echo $order->getStatusString() ?></div></td>
                        <td><?php echo $order->getValueEncoded('created_at') ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <div class="table-nav">
            <?php if( $data['start'] > 0 ) : ?>
                <a href="<?php echo APP_URL ?>admin/orders?start=<?php echo max($data['start'] - NUMBER_OF_ROWS, 0) . '&amp;status=' . $data['status'] ?>" title="Previous">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                        <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
                    </svg>
                </a>
            <?php endif; ?>

            <?php if( $data['start'] + NUMBER_OF_ROWS < $data['total_rows'] ) : ?>
                <a href="<?php echo APP_URL ?>admin/orders?start=<?php echo min($data['start'] + NUMBER_OF_ROWS, $data['total_rows']) . '&amp;status=' . $data['status'] ?>" title="Next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                        <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                    </svg>
                </a>
            <?php endif; ?>
        </div>
    </div>
</main>
<?php displayAdminPageFooter() ?>